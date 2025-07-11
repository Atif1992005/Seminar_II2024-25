function escapeHTML(str) {
    return String(str)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#39;');
}

document.addEventListener('DOMContentLoaded', function() {
    // Utility: Get username for dashboard greeting
    function fetchUsername() {
        fetch('../backend/session.php', { credentials: 'include' })
            .then(res => res.json())
            .then(data => {
                if (data.username && document.getElementById('dashboardUsername')) {
                    document.getElementById('dashboardUsername').textContent = data.username;
                }
            });
    }
    fetchUsername();

    // Login form handler
    if (document.getElementById('loginForm')) {
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
            fetch('../backend/auth.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ username, password }),
                credentials: 'include'
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    window.location.href = 'dashboard.html';
                } else {
                    const err = document.getElementById('loginError');
                    err.textContent = data.message;
                    err.style.display = 'block';
                }
            })
            .catch(() => {
                const err = document.getElementById('loginError');
                err.textContent = 'Login failed. Please try again.';
                err.style.display = 'block';
            });
        });
    }

    // Registration form handler
    if (document.getElementById('registerForm')) {
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const username = document.getElementById('reg_username').value;
            const email = document.getElementById('reg_email').value;
            const password = document.getElementById('reg_password').value;
            const confirm_password = document.getElementById('reg_confirm_password').value;
            fetch('../backend/register.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ username, email, password, confirm_password }),
                credentials: 'include'
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    window.location.href = 'dashboard.html';
                } else {
                    const err = document.getElementById('registerError');
                    err.textContent = data.message;
                    err.style.display = 'block';
                }
            })
            .catch(() => {
                const err = document.getElementById('registerError');
                err.textContent = 'Registration failed. Please try again.';
                err.style.display = 'block';
            });
        });
    }

    // Logout button handler
    if (document.getElementById('logoutBtn')) {
        document.getElementById('logoutBtn').addEventListener('click', function() {
            fetch('../backend/logout.php', { credentials: 'include' })
                .then(res => res.json())
                .then(() => {
                    window.location.href = 'index.html';
                });
        });
    }
    if (document.getElementById('logoutNav')) {
        document.getElementById('logoutNav').addEventListener('click', function(e) {
            e.preventDefault();
            fetch('../backend/logout.php', { credentials: 'include' })
                .then(res => res.json())
                .then(() => {
                    window.location.href = 'index.html';
                });
        });
    }

    // NOTES PAGE: Subject filter and notes list
    if (document.getElementById('notesList')) {
        let allNotes = [];
        let allSubjects = new Set();
        function renderNotesList(subject) {
            const notesList = document.getElementById('notesList');
            notesList.innerHTML = '';
            let filtered = subject && subject !== 'All' ? allNotes.filter(n => n.subject === subject) : allNotes;
            if (!filtered.length) {
                notesList.innerHTML = '<div class="card"><p>No notes found for the selected subject. Why not be the first to add one?</p></div>';
                return;
            }
            filtered.forEach(note => {
                const div = document.createElement('div');
                div.className = 'card';
                div.innerHTML = `<h3>${note.title} <span style="font-size: 0.9rem; color: #777; background: #f0f2f5; padding: 5px 10px; border-radius: 15px;">${note.subject}</span></h3><div class='note-content'>${note.content}</div>`;
                notesList.appendChild(div);
            });
        }
        function populateSubjects() {
            const select = document.getElementById('subjectFilter');
            select.innerHTML = '<option value="All">All Subjects</option>';
            Array.from(allSubjects).sort().forEach(subj => {
                const opt = document.createElement('option');
                opt.value = subj;
                opt.textContent = subj;
                select.appendChild(opt);
            });
        }
        fetch('../backend/notes.php', { credentials: 'include' })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    allNotes = data.notes.map(n => ({...n, subject: n.subject || 'General', title: n.title || 'Untitled'}));
                    allNotes.forEach(n => allSubjects.add(n.subject));
                    populateSubjects();
                    renderNotesList('All');
                }
            });
        document.getElementById('subjectFilter').addEventListener('change', function() {
            renderNotesList(this.value);
        });
    }

    // TODO PAGE: Add, delete, toggle todos
    if (document.getElementById('todoList')) {
        function renderTodos(todos) {
            const todoList = document.getElementById('todoList');
            todoList.innerHTML = '';
            if (!todos.length) {
                todoList.innerHTML = '<li class="todo-item">You have no pending tasks. Great job!</li>';
                return;
            }
            todos.forEach(task => {
                const li = document.createElement('li');
                li.className = 'todo-item' + (task.completed == 1 ? ' completed' : '');
                li.innerHTML = `<span>${task.task}</span><div class="actions">` +
                    `<a href="#" class="toggle-btn" data-id="${task.id}" title="Toggle status"><i class="fas fa-${task.completed == 1 ? 'undo' : 'check-circle'}"></i></a>` +
                    `<a href="#" class="delete-btn" data-id="${task.id}" title="Delete task"><i class="fas fa-trash-alt"></i></a></div>`;
                todoList.appendChild(li);
            });
            // Toggle and delete handlers
            document.querySelectorAll('.toggle-btn').forEach(btn => {
                btn.onclick = function(e) {
                    e.preventDefault();
                    fetch('../backend/todos.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ complete: this.dataset.id }),
                        credentials: 'include'
                    }).then(() => loadTodos());
                };
            });
            document.querySelectorAll('.delete-btn').forEach(btn => {
                btn.onclick = function(e) {
                    e.preventDefault();
                    if (confirm('Are you sure you want to delete this task?')) {
                        fetch('../backend/todos.php', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify({ delete: this.dataset.id }),
                            credentials: 'include'
                        }).then(() => loadTodos());
                    }
                };
            });
        }
        function loadTodos() {
            fetch('../backend/todos.php', { credentials: 'include' })
                .then(res => res.json())
                .then(data => {
                    if (data.success) renderTodos(data.todos);
                });
        }
        loadTodos();
        document.getElementById('addTaskForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const task = document.getElementById('newTaskInput').value;
            if (task && task.trim()) {
                fetch('../backend/todos.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ task }),
                    credentials: 'include'
                }).then(() => {
                    document.getElementById('newTaskInput').value = '';
                    loadTodos();
                });
            }
        });
    }

    // QUIZZES PAGE: Render quizzes grid
    if (document.getElementById('quizzesGrid')) {
        function renderQuizzes(quizzes) {
            const grid = document.getElementById('quizzesGrid');
            grid.innerHTML = '';
            if (!quizzes.length) {
                grid.innerHTML = '<p>No quizzes are available at the moment. Please check back later.</p>';
                return;
            }
            quizzes.forEach(quiz => {
                const div = document.createElement('div');
                div.className = 'card';
                div.innerHTML = `<h3>${quiz.title}</h3><p><strong>Subject:</strong> ${quiz.subject}</p><p>${quiz.question_count || 0} Questions</p><a href='take_quiz.html?id=${quiz.id}' class='btn'>Start Quiz</a>`;
                grid.appendChild(div);
            });
        }
        fetch('../backend/quizzes.php', { credentials: 'include' })
            .then(res => res.json())
            .then(data => {
                if (data.success) renderQuizzes(data.quizzes);
            });
    }

    // STUDY TIPS PAGE: Render tips by category
    if (document.getElementById('tipsContent')) {
        function renderTips(tipsByCategory) {
            const container = document.getElementById('tipsContent');
            container.innerHTML = '';
            for (const [category, tips] of Object.entries(tipsByCategory)) {
                const catHeader = document.createElement('h3');
                catHeader.style.marginLeft = '10px';
                catHeader.style.marginBottom = '15px';
                catHeader.style.color = '#764ba2';
                catHeader.textContent = category;
                container.appendChild(catHeader);
                const grid = document.createElement('div');
                grid.className = 'grid';
                grid.style.marginBottom = '30px';
                tips.forEach(tip => {
                    const div = document.createElement('div');
                    div.className = 'card';
                    div.innerHTML = `<h4 style='margin-top:0;'>${tip.title}</h4><div class='tip-content'>${tip.content}</div>`;
                    grid.appendChild(div);
                });
                container.appendChild(grid);
            }
        }
        fetch('../backend/study_tips.php', { credentials: 'include' })
            .then(res => res.json())
            .then(data => {
                if (data.success) renderTips(data.tips);
            });
    }

    // TAKE QUIZ PAGE: Render questions for selected quiz
    if (document.getElementById('quizQuestions')) {
        let quizData = null;
        // Get quiz id from URL if present
        const params = new URLSearchParams(window.location.search);
        const quizId = params.get('id');
        function renderQuiz(quiz) {
            quizData = quiz;
            const container = document.getElementById('quizQuestions');
            container.innerHTML = '';
            if (!quiz.questions || quiz.questions.length === 0) {
                container.innerHTML = '<div class="card"><p>No questions found for this quiz.</p></div>';
                return;
            }
            quiz.questions.forEach((q, idx) => {
                const qDiv = document.createElement('div');
                qDiv.className = 'card quiz-question';
                qDiv.style.marginBottom = '20px';
                qDiv.innerHTML = `<div class='question-text'><b>Q${idx+1}:</b> ${escapeHTML(q.question_text)}</div>
                    <div class='options' style='margin-top:10px;'>
                        <label style='display:block;margin-bottom:5px;'><input type='radio' name='q${q.id}' value='A' required> ${escapeHTML(q.option_a)}</label>
                        <label style='display:block;margin-bottom:5px;'><input type='radio' name='q${q.id}' value='B'> ${escapeHTML(q.option_b)}</label>
                        <label style='display:block;margin-bottom:5px;'><input type='radio' name='q${q.id}' value='C'> ${escapeHTML(q.option_c)}</label>
                        <label style='display:block;margin-bottom:5px;'><input type='radio' name='q${q.id}' value='D'> ${escapeHTML(q.option_d)}</label>
                    </div>`;
                container.appendChild(qDiv);
            });
        }
        // Fetch quiz by id if present, else random
        let url = '../backend/get_quiz.php';
        if (quizId) url += '?id=' + quizId;
        fetch(url, { credentials: 'include' })
            .then(res => res.json())
            .then(data => {
                if (data.success) renderQuiz(data.quiz);
                else document.getElementById('quizError').textContent = data.message;
            });
        document.getElementById('quizForm').addEventListener('submit', function(e) {
            e.preventDefault();
            if (!quizData) return;
            const answers = {};
            let allAnswered = true;
            quizData.questions.forEach(q => {
                const val = document.querySelector(`input[name='q${q.id}']:checked`);
                if (val) answers[q.id] = val.value;
                else allAnswered = false;
            });
            if (!allAnswered) {
                document.getElementById('quizError').textContent = 'Please answer all questions before submitting.';
                document.getElementById('quizError').style.display = 'block';
                return;
            }
            fetch('../backend/submit_quiz.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ quiz_id: quizData.id, answers }),
                credentials: 'include'
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    window.location.href = `quiz_result.html?score=${data.score}&total=${data.total}`;
                } else {
                    document.getElementById('quizError').textContent = data.message;
                    document.getElementById('quizError').style.display = 'block';
                }
            });
        });
    }

    // QUIZ RESULT PAGE: Show score and total from URL params
    if (document.getElementById('quizScore') && document.getElementById('quizTotal')) {
        const params = new URLSearchParams(window.location.search);
        const score = params.get('score');
        const total = params.get('total');
        document.getElementById('quizScore').textContent = score !== null ? score : '-';
        document.getElementById('quizTotal').textContent = total !== null ? total : '-';
    }

    // INDEX PAGE: Show/hide login/register/dashboard buttons based on session
    if (document.getElementById('welcome-buttons')) {
        fetch('../backend/session.php', { credentials: 'include' })
            .then(res => res.json())
            .then(data => {
                const dashboardBtn = document.getElementById('dashboardBtn');
                const loginBtn = document.getElementById('loginBtn');
                const registerBtn = document.getElementById('registerBtn');
                if (data.loggedIn) {
                    if (dashboardBtn) dashboardBtn.style.display = 'inline-block';
                    if (loginBtn) loginBtn.style.display = 'none';
                    if (registerBtn) registerBtn.style.display = 'none';
                } else {
                    if (dashboardBtn) dashboardBtn.style.display = 'none';
                    if (loginBtn) loginBtn.style.display = 'inline-block';
                    if (registerBtn) registerBtn.style.display = 'inline-block';
                }
            });
    }
}); 