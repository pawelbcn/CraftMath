<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>CraftMath: Tabliczka Mnożenia</title>
    <style>
        @font-face {
            font-family: 'PixelFont';
            src: url('https://cdnjs.cloudflare.com/ajax/libs/font-minecraft/5.8.1/font-minecraft.woff') format('woff');
            font-weight: normal;
            font-style: normal;
        }
        body {
            font-family: 'PixelFont', monospace;
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
            margin-bottom: 30px;
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
        /* Style dla ekranu startowego */
        .start-screen {
            text-align: center;
            padding: 40px 20px;
        }
        .start-screen h2 {
            color: #ffaa00;
            font-size: 24px;
            margin-bottom: 30px;
        }
        .mode-button {
            width: 250px;
            height: 60px;
            margin: 15px auto;
            font-family: 'PixelFont', monospace;
            font-size: 20px;
            background-color: #546454;
            border: 4px solid #2d3a2d;
            color: white;
            cursor: pointer;
            transition: all 0.1s;
            text-shadow: 2px 2px #000000;
            display: block;
            box-shadow: inset -3px -5px 0 1px rgba(0,0,0,0.3);
        }
        .mode-button:hover {
            background-color: #48a248;
            transform: translateY(-2px);
        }
        .mode-button:active {
            background-color: #3c873c;
            transform: translateY(0);
            box-shadow: inset 3px 3px 0 1px rgba(0,0,0,0.3);
        }
        .minecraft-logo {
            font-size: 48px;
            color: #ffff55;
            text-shadow: 3px 3px #3f3f3f;
            margin-bottom: 40px;
            letter-spacing: -2px;
        }
        /* Style dla wyboru liczby */
        .multiplier-selection {
            margin: 20px 0;
        }
        .multiplier-selection h3 {
            color: #ffaa00;
            margin-bottom: 15px;
        }
        .number-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
            margin-bottom: 20px;
        }
        .number-button {
            width: 60px;
            height: 60px;
            font-size: 24px;
            background-color: #7e7e7e;
            border: 3px solid #5c5c5c;
            color: white;
            cursor: pointer;
            transition: all 0.1s;
            text-shadow: 2px 2px #000000;
            box-shadow: inset -2px -3px 0 1px rgba(0,0,0,0.3);
        }
        .number-button:hover {
            background-color: #a0a0a0;
            transform: translateY(-2px);
        }
        .number-button.active {
            background-color: #ffaa00;
            border-color: #a56600;
        }
        .back-button {
            margin-top: 30px;
            padding: 10px 20px;
            font-family: 'PixelFont', monospace;
            font-size: 16px;
            background-color: #a15252;
            border: 3px solid #703838;
            color: white;
            cursor: pointer;
            transition: all 0.1s;
            text-shadow: 1px 1px #000000;
        }
        .back-button:hover {
            background-color: #c45a5a;
            transform: translateY(-2px);
        }
        .game-info {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 10px;
            border: 2px solid #2d2d2d;
            border-radius: 5px;
            font-size: 14px;
        }
        .game-info .multiplier {
            font-weight: bold;
            color: #ffaa00;
        }
        .game-info .mode {
            font-weight: bold;
            color: #7fcc19;
        }
        .hint-button {
            padding: 8px 15px;
            margin: 10px auto;
            font-family: 'PixelFont', monospace;
            font-size: 16px;
            background-color: #8B6D2E;
            border: 3px solid #594617;
            color: white;
            cursor: pointer;
            transition: all 0.1s;
            text-shadow: 1px 1px #000000;
            box-shadow: inset -2px -3px 0 1px rgba(0,0,0,0.3);
            display: block;
        }
        .hint-button:hover {
            background-color: #B08B3C;
            transform: translateY(-2px);
        }
        .hint-button:active {
            background-color: #8B6D2E;
            transform: translateY(0);
            box-shadow: inset 2px 2px 0 1px rgba(0,0,0,0.3);
        }
        .hidden {
            display: none !important;
        }
        .leaderboard-container {
            max-width: 80%;
            margin: 20px auto;
            background-color: #3f3f3f;
            border: 3px solid #2d2d2d;
            padding: 15px;
        }
        .leaderboard-title {
            color: #ffaa00;
            font-size: 20px;
            margin-bottom: 15px;
            text-transform: uppercase;
        }
        .leaderboard-table {
            width: 100%;
            border-collapse: collapse;
            color: white;
        }
        .leaderboard-table th {
            background-color: #2d2d2d;
            padding: 8px;
            text-align: left;
        }
        .leaderboard-table td {
            padding: 8px;
            border-bottom: 1px solid #555555;
        }
        .leaderboard-table tr:nth-child(even) {
            background-color: #4d4d4d;
        }
        .player-name-input {
            padding: 10px;
            margin: 10px 0;
            width: 60%;
            font-family: 'PixelFont', monospace;
            background-color: #3f3f3f;
            border: 2px solid #2d2d2d;
            color: white;
            text-shadow: 1px 1px #000000;
        }
        .save-score-button {
            padding: 10px 20px;
            font-family: 'PixelFont', monospace;
            background-color: #d69e2e;
            border: 2px solid #a67c1e;
            color: white;
            cursor: pointer;
            transition: all 0.1s;
            text-shadow: 1px 1px #000000;
            margin-left: 10px;
            box-shadow: inset -2px -3px 0 1px rgba(0,0,0,0.3);
        }
        .save-score-button:hover {
            background-color: #e6af3f;
            transform: translateY(-2px);
        }
        .github-link {
            margin-top: 20px;
            color: #7fcc19;
            text-decoration: none;
            font-size: 16px;
            padding: 5px;
            background-color: rgba(0, 0, 0, 0.3);
            border-radius: 5px;
        }
        .github-link:hover {
            color: #9fec39;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="game-container" id="game-container">
        <!-- Zostanie wypełnione przez JS -->
    </div>

    <script>
        // Zmienne gry
        let currentQuestion = 1;
        let score = 0;
        let totalQuestions = 10;
        let gameMode = 'learning'; // learning lub game
        let multiplier = 4; // domyślny mnożnik
        let usedNumbers = []; // Tablica używana w trybie losowym
        let currentScreen = 'start'; // start, multiplier-select, game, leaderboard
        let hintsVisible = false; // Czy podpowiedzi (zbiory) są widoczne
        let leaderboard = []; // Tablica wyników
        
        // Dźwięki
        const correctSound = new Audio("data:audio/wav;base64,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");
        const wrongSound = new Audio("data:audio/wav;base64,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");
        const clickSound = new Audio("data:audio/wav;base64,UklGRswCAABXQVZFZm10IBAAAAABAAEARKwAAESsAAACABAAZGF0YagCAAAiIiIpKSkzMzM+Pj5ISEhQUFBWVlZaWlpeXl5gYGBiYmJiYmJiYmJhYWFgYGBeXl5cXFxZWVlVVVVRUVFMTExGRkZAQEA5OTkyMjIrKyskJCQeHh4YGBgSEhINDQ0ICAgFBQUCAgIAAAAAAAAAAAAAAAAAAAAAAAAAAAACAgIFBQUICAgNDQ0SEhIYGBgeHh4kJCQrKysyMjI5OTlAQEBGRkZMTExRUVFVVVVZWVlcXFxeXl5gYGBhYWFiYmJiYmJiYmJgYGBeXl5aWlpWVlZQUFBISEg+Pj4zMzMpKSkiIiIcHBwVFRUPDw8KCgoGBgYDAwMBAQEAAAAAAAAAAAAAAAAAAAAAAAABAQEDAwMGBgYKCgoPDw8VFRUcHBwiIiIpKSkzMzM+Pj5ISEhQUFBWVlZaWlpeXl5gYGBiYmJiYmJiYmJhYWFgYGBeXl5cXFxZWVlVVVVRUVFMTExGRkZAQEA5OTkyMjIrKyskJCQeHh4YGBgSEhINDQ0ICAgFBQUCAgIAAAAAAAAAAAAAAAAAAAAAAAACAgIFBQUICAgNDQ0SEhIYGBgeHh4kJCQrKysyMjI5OTlAQEBGRkZMTExRUVFVVVVZWVlcXFxeXl5gYGBhYWFiYmJiYmJiYmJgYGBeXl5aWlpWVlZQUFBISEg+Pj4zMzMpKSkiIiIcHBwVFRUPDw8KCgoGBgYDAwMBAQEAAAAAAAAAAAAAAAAAAAAAAAABAQEDAwMGBgYKCgoPDw8VFRX/////////////////////");

        // Renderuj ekran startowy
        function renderStartScreen() {
            const container = document.getElementById('game-container');
            container.innerHTML = `
                <div class="start-screen">
                    <div class="minecraft-logo">CRAFTMATH</div>
                    <h1>TABLICZKA MNOŻENIA</h1>
                    <h2>Wybierz tryb gry:</h2>
                    <button id="learning-mode" class="mode-button">TRYB NAUKI</button>
                    <button id="game-mode" class="mode-button">TRYB GRY</button>
                    <button id="show-leaderboard" class="mode-button">TABLICA WYNIKÓW</button>
                    <a href="https://github.com/pawelbcn/CraftMath" class="github-link" target="_blank">Kod na GitHub</a>
                </div>
            `;
            
            // Dodaj nasłuchiwacze zdarzeń
            document.getElementById('learning-mode').addEventListener('click', () => {
                clickSound.play();
                gameMode = 'learning';
                currentScreen = 'multiplier-select';
                renderMultiplierScreen();
            });
            
            document.getElementById('game-mode').addEventListener('click', () => {
                clickSound.play();
                gameMode = 'game';
                currentScreen = 'game';
                resetGame();
            });
            
            document.getElementById('show-leaderboard').addEventListener('click', () => {
                clickSound.play();
                currentScreen = 'leaderboard';
                renderLeaderboard();
            });
            
            // Załaduj zapisane wyniki z localStorage
            loadLeaderboard();
        }
        
        // Renderuj ekran wyboru mnożnika (dla trybu nauki)
        function renderMultiplierScreen() {
            const container = document.getElementById('game-container');
            container.innerHTML = `
                <div class="start-screen">
                    <h1>TRYB NAUKI</h1>
                    <div class="multiplier-selection">
                        <h3>Wybierz liczbę do nauki mnożenia:</h3>
                        <div class="number-grid">
                            ${generateNumberButtons()}
                        </div>
                    </div>
                    <button id="start-learning" class="mode-button">ROZPOCZNIJ NAUKĘ</button>
                    <button id="back-to-start" class="back-button">POWRÓT</button>
                </div>
            `;
            
            // Zaznacz aktualnie wybrany mnożnik
            document.getElementById(`number-${multiplier}`).classList.add('active');
            
            // Dodaj nasłuchiwacze zdarzeń dla przycisków liczbowych
            for (let i = 1; i <= 10; i++) {
                document.getElementById(`number-${i}`).addEventListener('click', () => {
                    // Usuń aktywną klasę z poprzedniego przycisku
                    document.querySelectorAll('.number-button').forEach(btn => {
                        btn.classList.remove('active');
                    });
                    
                    // Dodaj aktywną klasę do nowego przycisku
                    document.getElementById(`number-${i}`).classList.add('active');
                    multiplier = i;
                    clickSound.play();
                });
            }
            
            // Nasłuchiwacz dla przycisku rozpoczęcia nauki
            document.getElementById('start-learning').addEventListener('click', () => {
                clickSound.play();
                currentScreen = 'game';
                resetGame();
            });
            
            // Nasłuchiwacz dla przycisku powrotu
            document.getElementById('back-to-start').addEventListener('click', () => {
                clickSound.play();
                currentScreen = 'start';
                renderStartScreen();
            });
        }
        
        // Generuj przyciski z liczbami
        function generateNumberButtons() {
            let buttons = '';
            for (let i = 1; i <= 10; i++) {
                buttons += `<button id="number-${i}" class="number-button">${i}</button>`;
            }
            return buttons;
        }
        
        // Funkcja do generowania kropek w zbiorze
        function createSet() {
            const set = document.createElement('div');
            set.classList.add('set');
            
            // Dodawanie kropek do zbioru (w zależności od mnożnika)
            for (let i = 0; i < multiplier; i++) {
                const dot = document.createElement('div');
                dot.classList.add('dot');
                set.appendChild(dot);
            }
            
            return set;
        }
        
        // Renderuj główny ekran gry
        function renderGameScreen() {
            const container = document.getElementById('game-container');
            
            // Informacja o trybie gry i mnożniku
            const modeText = gameMode === 'learning' ? 'Tryb Nauki' : 'Tryb Gry';
            
            container.innerHTML = `
                <div class="game-info">
                    <div>Tryb: <span class="mode">${modeText}</span></div>
                    ${gameMode === 'learning' ? `<div>Mnożenie przez: <span class="multiplier">${multiplier}</span></div>` : ''}
                </div>
                
                <h1>CRAFTMATH: TABLICZKA MNOŻENIA</h1>
                <div class="question-container">Ile to <span id="number">1</span> × <span id="multiplier-display">${multiplier}</span> = ?</div>
                <div class="equation ${gameMode === 'game' ? 'hidden' : ''}"><span id="sets-count">1</span> zbiorów po <span id="dots-count">${multiplier}</span> kropki</div>
                ${gameMode === 'game' ? '<button id="hint-button" class="hint-button">POKAŻ PODPOWIEDŹ</button>' : ''}
                <div class="sets-container ${gameMode === 'game' ? 'hidden' : ''}" id="sets-container"></div>
                <div class="options-container" id="options"></div>
                <div class="message" id="message"></div>
                <div class="stars-container" id="stars"></div>
                <div class="progress-container">
                    <div class="progress-bar" id="progress-bar"></div>
                </div>
                <button id="back-to-menu" class="back-button">POWRÓT DO MENU</button>
            `;
            
            // Dodaj nasłuchiwacz dla przycisku powrotu
            document.getElementById('back-to-menu').addEventListener('click', () => {
                clickSound.play();
                currentScreen = 'start';
                renderStartScreen();
            });
            
            // Dodaj nasłuchiwacz dla przycisku podpowiedzi (tylko w trybie gry)
            if (gameMode === 'game') {
                const hintButton = document.getElementById('hint-button');
                hintButton.addEventListener('click', () => {
                    clickSound.play();
                    hintsVisible = !hintsVisible;
                    const setsContainer = document.getElementById('sets-container');
                    const equation = document.querySelector('.equation');
                    
                    if (hintsVisible) {
                        setsContainer.classList.remove('hidden');
                        equation.classList.remove('hidden');
                        hintButton.textContent = 'UKRYJ PODPOWIEDŹ';
                    } else {
                        setsContainer.classList.add('hidden');
                        equation.classList.add('hidden');
                        hintButton.textContent = 'POKAŻ PODPOWIEDŹ';
                    }
                });
            }
            
            // Renderuj zbiory i opcje
            renderSets();
            renderOptions();
            updateStars();
        }
        
        // Reset gry
        function resetGame() {
            if (gameMode === 'learning') {
                currentQuestion = 1;
            } else { // game mode
                currentQuestion = getRandomNumber();
                usedNumbers = [currentQuestion];
                hintsVisible = false; // Resetuj stan podpowiedzi w trybie gry
            }
            
            score = 0;
            renderGameScreen();
            updateProgress();
        }
        
        // Funkcja do generowania losowej liczby (1-10) bez powtórzeń
        function getRandomNumber() {
            if (usedNumbers.length >= 10) {
                usedNumbers = []; // Wszystkie liczby zostały użyte, resetuj
            }
            
            let randomNum;
            do {
                randomNum = Math.floor(Math.random() * 10) + 1;
            } while (usedNumbers.includes(randomNum));
            
            return randomNum;
        }
        
        // Renderowanie zbiorów
        function renderSets() {
            const setsContainer = document.getElementById('sets-container');
            if (!setsContainer) return;
            
            setsContainer.innerHTML = '';
            
            // Tworzenie odpowiedniej liczby zbiorów
            for (let i = 0; i < currentQuestion; i++) {
                const set = createSet();
                setsContainer.appendChild(set);
            }
            
            // Aktualizacja tekstu pytania
            document.getElementById('number').textContent = currentQuestion;
            document.getElementById('sets-count').textContent = currentQuestion;
            
            // W trybie gry, losowo wybieramy mnożnik dla każdego pytania
            if (gameMode === 'game') {
                const randomMultiplier = Math.floor(Math.random() * 9) + 2; // 2-10
                multiplier = randomMultiplier;
                document.getElementById('multiplier-display').textContent = multiplier;
                document.getElementById('dots-count').textContent = multiplier;
                
                // Usuń wszystkie kropki z istniejących zbiorów
                const sets = document.querySelectorAll('.set');
                sets.forEach(set => {
                    set.innerHTML = '';
                    
                    // Dodaj nową liczbę kropek odpowiadającą mnożnikowi
                    for (let i = 0; i < multiplier; i++) {
                        const dot = document.createElement('div');
                        dot.classList.add('dot');
                        set.appendChild(dot);
                    }
                });
            }
        }
        
        // Renderowanie opcji odpowiedzi
        function renderOptions() {
            const optionsContainer = document.getElementById('options');
            if (!optionsContainer) return;
            
            optionsContainer.innerHTML = '';
            
            const correctAnswer = currentQuestion * multiplier;
            let options = [correctAnswer];
            
            // Dodawanie innych opcji (niepoprawnych)
            while (options.length < 4) {
                // Generuj losową wartość w zakresie ±10 od poprawnej odpowiedzi, ale nie mniejszą niż 1
                let randomOffset = Math.floor(Math.random() * 21) - 10;
                let randomOption = Math.max(1, correctAnswer + randomOffset);
                
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
            if (!message) return;
            
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
                
                // Jeśli jesteśmy w trybie gry, pokażmy zbiory na moment a potem ukryjmy z powrotem
                if (gameMode === 'game' && !hintsVisible) {
                    const setsContainer = document.getElementById('sets-container');
                    const equation = document.querySelector('.equation');
                    
                    setsContainer.classList.remove('hidden');
                    equation.classList.remove('hidden');
                    
                    setTimeout(() => {
                        setsContainer.classList.add('hidden');
                        equation.classList.add('hidden');
                    }, 1500);
                }
                
                setTimeout(() => {
                    updateStars();
                    // Dodaj efekt dźwiękowy "doświadczenie" w stylu Minecraft
                    const xpSound = new Audio("data:audio/wav;base64,UklGRpYBAABXQVZFZm10IBAAAAABAAEARKwAAESsAAACABAAZGF0YXIBAABJSUlWVlZjY2NwcHB9fX2IiIiSkpKampqgoKCjo6OkpKSjo6OgoKCbm5uVlZWNjY2EhIR7e3tycnJqampjY2NdXV1XV1dTU1NPT09NTU1MTExNTU1PT09SUlJWVlZbW1thYWFnZ2dtbW1zc3N4eHh8fHx/f3+AgIB/f39+fn57e3t3d3dycnJsbGxmZmZfX19ZWVlTU1NNTUilpaWsrKyzs7O5ubm+vr7BwcHDw8PExMTDw8PCwsK/v7+7u7u3t7exsbGqqqmjo6Obm5uTk5OLi4uDg4N8fHx2dnZxcXFtbW1qampnZ2dlZWVlZWVmZmZoaGhqampubm5xcXF1dXV4eHh7e3t9fX1/f3+AgICAf39/f39+fn58fHx5eXl2dnZycnJubm5qampkZGRe");
                    xpSound.volume = 0.5;
                    xpSound.play();
                    updateProgress();
                    
                    if (score < totalQuestions) {
                        // Wybierz następne pytanie w zależności od trybu
                        if (gameMode === 'learning') {
                            currentQuestion++;
                            if (currentQuestion > 10) {
                                currentQuestion = 1;
                            }
                        } else { // game mode
                            currentQuestion = getRandomNumber();
                            usedNumbers.push(currentQuestion);
                        }
                        
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
            if (starsContainer) {
                starsContainer.innerHTML = '⭐'.repeat(score);
            }
        }
        
        // Aktualizacja paska postępu
        function updateProgress() {
            const progressBar = document.getElementById('progress-bar');
            if (progressBar) {
                const progress = (score / totalQuestions) * 100;
                progressBar.style.width = progress + '%';
            }
        }
        
        // Zakończenie gry
        function endGame() {
            const gameContainer = document.getElementById('game-container');
            const optionsContainer = document.getElementById('options');
            const setsContainer = document.getElementById('sets-container');
            const questionContainer = document.querySelector('.question-container');
            const equation = document.querySelector('.equation');
            const message = document.getElementById('message');
            const backButton = document.getElementById('back-to-menu');
            
            if (!message || !backButton) return;
            
            optionsContainer.innerHTML = '';
            setsContainer.innerHTML = '';
            questionContainer.style.display = 'none';
            equation.style.display = 'none';
            backButton.style.display = 'none';
            
            let messageText = '';
            if (score >= 8) {
                messageText = 'Wspaniale! Jesteś mistrzem tabliczki mnożenia!';
                message.style.color = 'green';
            } else if (score >= 5) {
                messageText = 'Dobra robota! Ćwicz dalej!';
                message.style.color = 'blue';
            } else {
                messageText = 'Próbuj dalej! Z każdym razem będzie lepiej!';
                message.style.color = 'purple';
            }
            
            // Podsumowanie wyników
            messageText = `${messageText}<br>Twój wynik: ${score} z ${totalQuestions} punktów!`;
            message.innerHTML = messageText;
            
            // Formularz do zapisania wyniku
            const scoreForm = document.createElement('div');
            scoreForm.style.margin = '20px';
            scoreForm.innerHTML = `
                <input type="text" class="player-name-input" id="player-name" placeholder="Wpisz swoje imię" maxlength="15">
                <button class="save-score-button" id="save-score">ZAPISZ WYNIK</button>
            `;
            gameContainer.appendChild(scoreForm);
            
            // Nasłuchiwacz do zapisywania wyniku
            document.getElementById('save-score').addEventListener('click', () => {
                const playerName = document.getElementById('player-name').value.trim();
                if (playerName) {
                    clickSound.play();
                    saveScore(playerName, score, gameMode, multiplier);
                    scoreForm.innerHTML = '<div style="color: green; margin: 10px 0;">Wynik zapisany!</div>';
                    
                    setTimeout(() => {
                        renderLeaderboard();
                    }, 1000);
                } else {
                    alert('Proszę wpisać imię!');
                }
            });
            
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
            playAgainButton.style.fontFamily = 'PixelFont', monospace;
            
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
                resetGame();
            });
            
            // Przycisk powrotu do menu głównego
            const backToMenuButton = document.createElement('button');
            backToMenuButton.textContent = 'POWRÓT DO MENU';
            backToMenuButton.style.padding = '10px 20px';
            backToMenuButton.style.fontSize = '16px';
            backToMenuButton.style.backgroundColor = '#a15252';
            backToMenuButton.style.border = '4px solid #703838';
            backToMenuButton.style.color = 'white';
            backToMenuButton.style.margin = '20px';
            backToMenuButton.style.cursor = 'pointer';
            backToMenuButton.style.textShadow = '2px 2px #000000';
            backToMenuButton.style.boxShadow = 'inset -2px -4px 0 1px rgba(0,0,0,0.3)';
            backToMenuButton.style.fontFamily = 'PixelFont', monospace;
            
            backToMenuButton.addEventListener('mouseover', () => {
                backToMenuButton.style.backgroundColor = '#c45a5a';
            });
            
            backToMenuButton.addEventListener('mouseout', () => {
                backToMenuButton.style.backgroundColor = '#a15252';
            });
            
            backToMenuButton.addEventListener('click', () => {
                clickSound.play();
                currentScreen = 'start';
                renderStartScreen();
            });
            
            gameContainer.appendChild(playAgainButton);
            gameContainer.appendChild(backToMenuButton);
        }
        
        // Funkcje dla tablicy wyników
        
        // Załaduj tablicę wyników z localStorage
        function loadLeaderboard() {
            const savedLeaderboard = localStorage.getItem('craftMathLeaderboard');
            if (savedLeaderboard) {
                leaderboard = JSON.parse(savedLeaderboard);
            }
        }
        
        // Zapisz wynik do tablicy wyników
        function saveScore(playerName, score, mode, mult) {
            const newScore = {
                name: playerName,
                score: score,
                mode: mode === 'learning' ? 'Nauka' : 'Gra',
                multiplier: mult,
                date: new Date().toLocaleDateString()
            };
            
            // Dodaj do tablicy wyników
            leaderboard.push(newScore);
            
            // Sortuj wyniki malejąco według punktów
            leaderboard.sort((a, b) => b.score - a.score);
            
            // Ogranicz listę do 20 najlepszych wyników
            if (leaderboard.length > 20) {
                leaderboard = leaderboard.slice(0, 20);
            }
            
            // Zapisz do localStorage
            localStorage.setItem('craftMathLeaderboard', JSON.stringify(leaderboard));
        }
        
        // Renderuj ekran tablicy wyników
        function renderLeaderboard() {
            const container = document.getElementById('game-container');
            
            let tableContent = '';
            leaderboard.forEach((entry, index) => {
                tableContent += `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${entry.name}</td>
                        <td>${entry.score}</td>
                        <td>${entry.mode}</td>
                        <td>${entry.mode === 'Nauka' ? 'x' + entry.multiplier : 'Mix'}</td>
                        <td>${entry.date}</td>
                    </tr>
                `;
            });
            
            container.innerHTML = `
                <div class="start-screen">
                    <h1>TABLICA WYNIKÓW</h1>
                    <div class="leaderboard-container">
                        <div class="leaderboard-title">Najlepsze wyniki</div>
                        <table class="leaderboard-table">
                            <thead>
                                <tr>
                                    <th>Lp.</th>
                                    <th>Gracz</th>
                                    <th>Punkty</th>
                                    <th>Tryb</th>
                                    <th>Mnożnik</th>
                                    <th>Data</th>
                                </tr>
                            </thead>
                            <tbody>
                                ${tableContent || '<tr><td colspan="6" style="text-align: center;">Brak zapisanych wyników</td></tr>'}
                            </tbody>
                        </table>
                    </div>
                    <button id="back-to-menu" class="back-button">POWRÓT DO MENU</button>
                </div>
            `;
            
            // Dodaj nasłuchiwacz dla przycisku powrotu
            document.getElementById('back-to-menu').addEventListener('click', () => {
                clickSound.play();
                currentScreen = 'start';
                renderStartScreen();
            });
        }

        // Inicjalizacja gry - rozpocznij od ekranu startowego
        renderStartScreen();
    </script>
</body>
</html>
