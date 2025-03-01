<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Zbiory i Tabliczka Mnożenia przez 4</title>
    <style>
        @font-face {
            font-family: 'Minecraft';
            src: url('https://cdnjs.cloudflare.com/ajax/libs/font-minecraft/5.8.1/font-minecraft.woff') format('woff');
            font-weight: normal;
            font-style: normal;
        }
        body {
            font-family: 'Minecraft', monospace;
            background-color: #8b8b8b;
            background-image: linear-gradient(rgba(0, 0, 0, 0.2) 1px, transparent 1px),
                             linear-gradient(90deg, rgba(0, 0, 0, 0.2) 1px, transparent 1px);
            background-size: 32px 32px;
            text-align: center;
            margin: 0;
            padding: 20px;
            image-rendering: pixelated;
            color: white;
            text-shadow: 2px 2px #000000;
        }
        .game-container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #5c5c5c;
            border: 4px solid #2d2d2d;
            padding: 20px;
            box-shadow: 0 0 0 4px #7e7e7e;
            image-rendering: pixelated;
        }
        h1 {
            color: #ffff55;
            font-size: 28px;
            text-transform: uppercase;
        }
        .question-container {
            margin: 20px;
            font-size: 42px;
            font-weight: bold;
            color: #ffffff;
        }
        .sets-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            margin: 20px;
        }
        .set {
            width: 80px;
            height: 80px;
            border: 4px solid #664d00;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            align-items: center;
            padding: 10px;
            background-color: #ce9c0e;
            image-rendering: pixelated;
            position: relative;
        }
        .set::before {
            content: '';
            position: absolute;
            top: 3px;
            left: 3px;
            right: 3px;
            bottom: 3px;
            background: linear-gradient(135deg, rgba(255,255,255,0.3) 0%, rgba(255,255,255,0) 50%);
            pointer-events: none;
        }
        .dot {
            width: 16px;
            height: 16px;
            background-color: #ff0000;
            border: 2px solid #7e0000;
            box-shadow: inset -2px -2px 0 1px rgba(0,0,0,0.3);
        }
        .options-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
            margin: 20px;
        }
        .option-button {
            width: 80px;
            height: 80px;
            font-size: 28px;
            background-color: #546454;
            border: 4px solid #2d3a2d;
            cursor: pointer;
            transition: all 0.1s;
            color: white;
            font-weight: bold;
            text-shadow: 2px 2px #000000;
            position: relative;
            box-shadow: inset -2px -4px 0 1px rgba(0,0,0,0.3);
            image-rendering: pixelated;
        }
        .option-button:hover {
            background-color: #48a248;
            transform: translateY(-2px);
        }
        .option-button:active {
            background-color: #3c873c;
            transform: translateY(0);
            box-shadow: inset 2px 2px 0 1px rgba(0,0,0,0.3);
        }
        .stars-container {
            margin: 20px;
            font-size: 30px;
            letter-spacing: 5px;
        }
        .message {
            font-size: 24px;
            margin: 20px;
            height: 30px;
            color: #ffaa00;
        }
        .progress-container {
            width: 80%;
            margin: 20px auto;
            background-color: #3f3f3f;
            border: 2px solid #1e1e1e;
            height: 20px;
            padding: 3px;
        }
        .progress-bar {
            width: 0%;
            height: 100%;
            background-color: #5b8731;
            transition: width 0.5s;
            background-image: linear-gradient(rgba(255, 255, 255, 0.2) 1px, transparent 1px),
                              linear-gradient(90deg, rgba(255, 255, 255, 0.2) 1px, transparent 1px);
            background-size: 4px 4px;
        }
        .equation {
            font-size: 18px;
            margin: 15px;
            color: #666666;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="game-container">
        <h1>MINECRAFT: TABLICZKA MNOŻENIA</h1>
        <div class="question-container">Ile to <span id="number">1</span> × 4 = ?</div>
        <div class="equation"><span id="sets-count">1</span> zbiorów po 4 kropki</div>
        <div class="sets-container" id="sets-container"></div>
        <div class="options-container" id="options"></div>
        <div class="message" id="message"></div>
        <div class="stars-container" id="stars"></div>
        <div class="progress-container">
            <div class="progress-bar" id="progress-bar"></div>
        </div>
    </div>

    <script>
        // Zmienne gry
        let currentQuestion = 1;
        let score = 0;
        let totalQuestions = 10;
        const correctSound = new Audio("data:audio/wav;base64,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");
        const wrongSound = new Audio("data:audio/wav;base64,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");

        // Funkcja do generowania kropek w zbiorze
        function createSet() {
            const set = document.createElement('div');
            set.classList.add('set');
            
            // Dodawanie 4 kropek do zbioru
            for (let i = 0; i < 4; i++) {
                const dot = document.createElement('div');
                dot.classList.add('dot');
                set.appendChild(dot);
            }
            
            return set;
        }

        // Główna funkcja gry
        function startGame() {
            updateQuestion();
            renderSets();
            renderOptions();
        }

        // Aktualizacja pytania
        function updateQuestion() {
            document.getElementById('number').textContent = currentQuestion;
            document.getElementById('sets-count').textContent = currentQuestion;
        }

        // Renderowanie zbiorów
        function renderSets() {
            const setsContainer = document.getElementById('sets-container');
            setsContainer.innerHTML = '';
            
            // Tworzenie odpowiedniej liczby zbiorów (każdy po 4 kropki)
            for (let i = 0; i < currentQuestion; i++) {
                const set = createSet();
                setsContainer.appendChild(set);
            }
        }

        // Renderowanie opcji odpowiedzi
        function renderOptions() {
            const optionsContainer = document.getElementById('options');
            optionsContainer.innerHTML = '';
            
            const correctAnswer = currentQuestion * 4;
            let options = [correctAnswer];
            
            // Dodawanie innych opcji (niepoprawnych)
            while (options.length < 4) {
                const randomOption = Math.floor(Math.random() * 40) + 1;
                if (randomOption !== correctAnswer && !options.includes(randomOption)) {
                    options.push(randomOption);
                }
            }
            
            // Mieszanie opcji
            options = options.sort(() => Math.random() - 0.5);
            
            // Tworzenie przycisków z opcjami
            options.forEach(option => {
                const button = document.createElement('button');
                button.classList.add('option-button');
                button.textContent = option;
                button.addEventListener('click', () => checkAnswer(option, correctAnswer));
                optionsContainer.appendChild(button);
            });
        }

        // Sprawdzanie odpowiedzi
        function checkAnswer(selectedOption, correctAnswer) {
            const message = document.getElementById('message');
            
            if (selectedOption === correctAnswer) {
                message.textContent = 'Brawo! Dobra odpowiedź!';
                message.style.color = 'green';
                score++;
                correctSound.play();
                
                // Podświetlanie zbiorów dla wizualnego efektu
                const sets = document.querySelectorAll('.set');
                sets.forEach(set => {
                    set.style.backgroundColor = '#68b337';
                    set.style.borderColor = '#3a6b15';
                    // Dodaj efekt dźwiękowy "pop" w stylu Minecraft
                    const popSound = new Audio("data:audio/wav;base64,UklGRqwCAABXQVZFZm10IBAAAAABAAEARKwAABCxAgAEABAAZGF0YYgCAACAgICAgICAgICAgICAgICAgICAgICAgICBgYGCgoKCg4ODg4SEhISFhYWGhoaGh4eHiIiIiImJiYmKioqLi4uLjIyMjI2NjY6Ojo+Pj5CQkJGRkZGSkpKTk5OTlJSUlZWVlZaWlpeXl5eYmJiZmZmampqam5ubnJycnZ2dnZ6enp+fn5+goKChoaGhoqKio6Ojo6SkpKWlpaWmpqampqanp6enqKioqampqaqqqqurq6usrKysra2tra2trq6urq+vr6+wsLCxsbGxsrKysrOzs7O0tLS0tbW1tbW1tra2tre3t7e4uLi4ubm5ubq6uru7u7u8vLy8vb29vb6+vr6/v7+/wMDAwMHBwcHCwsLCw8PDw8TExMTFxcXFxsbGxsfHx8fIyMjIycnJycrKysrLy8vLzMzMzM3Nzc3Ozs7Oz8/Pz9DQ0NDR0dHR0tLS0tPT09PU1NTU1dXV1dbW1tbX19fX2NjY2NnZ2dna2trb29vb3Nzc3N3d3d3e3t7e39/f3+Dg4ODh4eHh4uLi4uPj4+Pk5OTk5eXl5ebm5ubn5+fn6Ojo6Onp6enq6urq6+vr6+zs7Ozt7e3t7u7u7u/v7+/w8PDw8fHx8fLy8vLz8/Pz9PT09PX19fX29vb29/f39/j4+Pj5+fn5+vr6+vv7+/v8/Pz8/f39/f7+/v7///////////////////////////////////////////8=");
                    popSound.volume = 0.3;
                    popSound.play();
                });
                
                setTimeout(() => {
                    updateStars();
            // Dodaj efekt dźwiękowy "doświadczenie" w stylu Minecraft
            const xpSound = new Audio("data:audio/wav;base64,UklGRpYBAABXQVZFZm10IBAAAAABAAEARKwAAESsAAACABAAZGF0YXIBAABJSUlWVlZjY2NwcHB9fX2IiIiSkpKampqgoKCjo6OkpKSjo6OgoKCbm5uVlZWNjY2EhIR7e3tycnJqampjY2NdXV1XV1dTU1NPT09NTU1MTExNTU1PT09SUlJWVlZbW1thYWFnZ2dtbW1zc3N4eHh8fHx/f3+AgIB/f39+fn57e3t3d3dycnJsbGxmZmZfX19ZWVlTU1NNTUilpaWsrKyzs7O5ubm+vr7BwcHDw8PExMTDw8PCwsK/v7+7u7u3t7exsbGqqqmjo6Obm5uTk5OLi4uDg4N8fHx2dnZxcXFtbW1qampnZ2dlZWVlZWVmZmZoaGhqampubm5xcXF1dXV4eHh7e3t9fX1/f3+AgICAf39/f39+fn58fHx5eXl2dnZycnJubm5qampkZGRe");
            xpSound.volume = 0.5;
            xpSound.play();
                    updateProgress();
                    
                    if (currentQuestion < totalQuestions) {
                        currentQuestion++;
                        updateQuestion();
                        renderSets();
                        renderOptions();
                        message.textContent = '';
                    } else {
                        endGame();
                    }
                }, 1500);
            } else {
                message.textContent = 'Spróbuj jeszcze raz!';
                message.style.color = 'red';
                wrongSound.play();
                
                // Efekt wizualny dla niepoprawnej odpowiedzi
                const sets = document.querySelectorAll('.set');
                sets.forEach(set => {
                    set.style.backgroundColor = '#a12722';
                    set.style.borderColor = '#700000';
                    
                    // Dodaj efekt dźwiękowy "uszkodzenie" w stylu Minecraft
                    const damageSound = new Audio("data:audio/wav;base64,UklGRt4DAABXQVZFZm10IBAAAAABAAEARKwAAESsAAACABAAZGF0YboDAABsbm5sbGxra2tra2pqampqaWlpaWhpaWhoaGhoZ2dnZ2dmZmZmZmZlZWVlZWRkZGRkY2NjY2NiYmJiYmJhYWFhYWFgYGBgYGBfX19fX19eXl5eXl1dXV1dXVxcXFxcW1tbW1taWlpaWllZWVlZWVhYWFhYV1dXV1dWVlZWVlZVVVVVVVVUVFRUVFNTU1NTU1JSUlJSUlFRUVFRUVBQUFBQT09PT09PTk5OTk5OTU1NTU1NTExMTExMS0tLS0tLSkpKSkpKSUlJSUlJSEhISEhIR0dHR0dHRkZGRkZGRUVFRUVFRERERERDQ0NDQ0NCQkJCQkJBQUFBQUFAQEBAQEA/Pz8/Pz8+Pj4+Pj49PT09PT08PDw8PDw7Ozs7Ozs6Ojo6Ojo5OTk5OTk4ODg4ODg3Nzc3Nzc2NjY2NjY1NTU1NTU0NDQ0NDQzMzMzMzMyMjIyMjIxMTExMTExMDAwMDAwLy8vLy8vLi4uLi4uLS0tLS0tLCwsLCwsKysrKysrKioqKioqKSkpKSkpKCgoKCgoJycnJycnJiYmJiYmJSUlJSUlJCQkJCQkIyMjIyMjIiIiIiIiISEhISEhICAgICAgHx8fHx8fHh4eHh4eHR0dHR0dHBwcHBwcGxsbGxsbGhoaGhoaGRkZGRkZGBgYGBgYFxcXFxcXFhYWFhYWFRUVFRUVFBQUFBQUExMTExMTEhISEhISEREREREREBAQEBAQDw8PDw8PDg4ODg4ODQ0NDQ0NDAwMDAwMCwsLCwsLCgoKCgoKCQkJCQkJCAgICAgIBwcHBwcHBgYGBgYGBQUFBQUFBAQEBAQEAwMDAwMDAgICAgICAQEBAQEBAAAAAAAAf39/f39/fn5+fn5+fX19fX19fHx8fHx8e3t7e3t7enp6enp6eXl5eXl5eHh4eHh4d3d3d3d3dnZ2dnZ2dXV1dXV1dHR0dHR0c3Nzc3Nzc3Jycm9wcG5wcG9wcHFycnJzc3N0dHR1dXV2dnZ3d3d4eHh4eXl5enp6e3t7e3x8fH19fX5+fn9/f4CAgIGBgYKCgoODg4SEhIWFhYaGhoeHh4iIiImJiYqKiouLi4yMjI2NjY6Ojo+Pj5CQkJGRkZKSkpOTk5SUlJWVlZaWlpeXl5iYmJmZmZqampubm5ycnJ2dnZ6enp+fn6CgoKGhoaKioqOjo6SkpKWlpaampqenp6ioqKmpqaqqqqurq6ysrK2tra6urq+vr7CwsLGxsbKysrOzs7S0tLW1tba2tre3t7i4uLm5ubq6uru7u7y8vL29vb6+vr+/v8DAwMHBwcLCwsPDw8TExMXFxcbGxsfHx8jIyA==");
                    damageSound.volume = 0.3;
                    damageSound.play();
                    
                    setTimeout(() => {
                        set.style.backgroundColor = '#ce9c0e';
                        set.style.borderColor = '#664d00';
                    }, 500);
                });
                
                setTimeout(() => {
                    message.textContent = '';
                }, 1500);
            }
        }

        // Aktualizacja gwiazdek
        function updateStars() {
            const starsContainer = document.getElementById('stars');
            starsContainer.innerHTML = '⭐'.repeat(score);
        }

        // Aktualizacja paska postępu
        function updateProgress() {
            const progressBar = document.getElementById('progress-bar');
            const progress = (currentQuestion / totalQuestions) * 100;
            progressBar.style.width = progress + '%';
        }

        // Zakończenie gry
        function endGame() {
            const gameContainer = document.querySelector('.game-container');
            const optionsContainer = document.getElementById('options');
            const setsContainer = document.getElementById('sets-container');
            const questionContainer = document.querySelector('.question-container');
            const equation = document.querySelector('.equation');
            const message = document.getElementById('message');
            
            optionsContainer.innerHTML = '';
            setsContainer.innerHTML = '';
            questionContainer.style.display = 'none';
            equation.style.display = 'none';
            
            if (score >= 8) {
                message.textContent = 'Wspaniale! Jesteś mistrzem tabliczki mnożenia!';
                message.style.color = 'green';
            } else if (score >= 5) {
                message.textContent = 'Dobra robota! Ćwicz dalej!';
                message.style.color = 'blue';
            } else {
                message.textContent = 'Próbuj dalej! Z każdym razem będzie lepiej!';
                message.style.color = 'purple';
            }
            
            // Podsumowanie wyników
            const resultText = document.createElement('div');
            resultText.textContent = `Zdobyłeś ${score} z ${totalQuestions} punktów!`;
            resultText.style.fontSize = '24px';
            resultText.style.margin = '20px';
            resultText.style.color = '#4b0082';
            gameContainer.appendChild(resultText);
            
            // Wizualizacja wyniku
            const resultContainer = document.createElement('div');
            resultContainer.style.display = 'flex';
            resultContainer.style.justifyContent = 'center';
            resultContainer.style.flexWrap = 'wrap';
            resultContainer.style.gap = '10px';
            resultContainer.style.margin = '20px';
            
            for (let i = 0; i < score; i++) {
                const successSet = createSet();
                successSet.style.backgroundColor = '#d4ffcc';
                successSet.style.borderColor = '#00cc00';
                resultContainer.appendChild(successSet);
            }
            
            gameContainer.appendChild(resultContainer);
            
            // Przycisk do ponownej gry w stylu Minecraft
            const playAgainButton = document.createElement('button');
            playAgainButton.textContent = 'ZAGRAJ JESZCZE RAZ';
            playAgainButton.style.padding = '10px 20px';
            playAgainButton.style.fontSize = '20px';
            playAgainButton.style.backgroundColor = '#1d8b1d';
            playAgainButton.style.border = '4px solid #0e5e0e';
            playAgainButton.style.color = 'white';
            playAgainButton.style.margin = '20px';
            playAgainButton.style.cursor = 'pointer';
            playAgainButton.style.textShadow = '2px 2px #000000';
            playAgainButton.style.boxShadow = 'inset -2px -4px 0 1px rgba(0,0,0,0.3)';
            playAgainButton.style.position = 'relative';
            playAgainButton.style.fontFamily = 'Minecraft, monospace';
            
            // Efekt dźwiękowy kliknięcia w stylu Minecraft
            const clickSound = new Audio("data:audio/wav;base64,UklGRswCAABXQVZFZm10IBAAAAABAAEARKwAAESsAAACABAAZGF0YagCAAAiIiIpKSkzMzM+Pj5ISEhQUFBWVlZaWlpeXl5gYGBiYmJiYmJiYmJhYWFgYGBeXl5cXFxZWVlVVVVRUVFMTExGRkZAQEA5OTkyMjIrKyskJCQeHh4YGBgSEhINDQ0ICAgFBQUCAgIAAAAAAAAAAAAAAAAAAAAAAAAAAAACAgIFBQUICAgNDQ0SEhIYGBgeHh4kJCQrKysyMjI5OTlAQEBGRkZMTExRUVFVVVVZWVlcXFxeXl5gYGBhYWFiYmJiYmJiYmJgYGBeXl5aWlpWVlZQUFBISEg+Pj4zMzMpKSkiIiIcHBwVFRUPDw8KCgoGBgYDAwMBAQEAAAAAAAAAAAAAAAAAAAAAAAABAQEDAwMGBgYKCgoPDw8VFRUcHBwiIiIpKSkzMzM+Pj5ISEhQUFBWVlZaWlpeXl5gYGBiYmJiYmJiYmJhYWFgYGBeXl5cXFxZWVlVVVVRUVFMTExGRkZAQEA5OTkyMjIrKyskJCQeHh4YGBgSEhINDQ0ICAgFBQUCAgIAAAAAAAAAAAAAAAAAAAAAAAACAgIFBQUICAgNDQ0SEhIYGBgeHh4kJCQrKysyMjI5OTlAQEBGRkZMTExRUVFVVVVZWVlcXFxeXl5gYGBhYWFiYmJiYmJiYmJgYGBeXl5aWlpWVlZQUFBISEg+Pj4zMzMpKSkiIiIcHBwVFRUPDw8KCgoGBgYDAwMBAQEAAAAAAAAAAAAAAAAAAAAAAAABAQEDAwMGBgYKCgoPDw8VFRX/////////////////////");
            
            playAgainButton.addEventListener('mouseover', () => {
                playAgainButton.style.backgroundColor = '#28a428';
            });
            
            playAgainButton.addEventListener('mouseout', () => {
                playAgainButton.style.backgroundColor = '#1d8b1d';
            });
            
            playAgainButton.addEventListener('mousedown', () => {
                playAgainButton.style.backgroundColor = '#167316';
                playAgainButton.style.transform = 'translateY(2px)';
                playAgainButton.style.boxShadow = 'inset 2px 2px 0 1px rgba(0,0,0,0.3)';
                clickSound.play();
            });
            
            playAgainButton.addEventListener('mouseup', () => {
                playAgainButton.style.backgroundColor = '#1d8b1d';
                playAgainButton.style.transform = 'translateY(0)';
                playAgainButton.style.boxShadow = 'inset -2px -4px 0 1px rgba(0,0,0,0.3)';
            });
            
            playAgainButton.addEventListener('click', () => {
                currentQuestion = 1;
                score = 0;
                questionContainer.style.display = 'block';
                equation.style.display = 'block';
                message.textContent = '';
                
                // Usunięcie elementów podsumowania
                if (resultText.parentNode) {
                    resultText.parentNode.removeChild(resultText);
                }
                if (resultContainer.parentNode) {
                    resultContainer.parentNode.removeChild(resultContainer);
                }
                if (playAgainButton.parentNode) {
                    playAgainButton.parentNode.removeChild(playAgainButton);
                }
                
                updateStars();
                updateProgress();
                startGame();
            });
            
            gameContainer.appendChild(playAgainButton);
        }

        // Uruchomienie gry
        startGame();
    </script>
</body>
</html>
