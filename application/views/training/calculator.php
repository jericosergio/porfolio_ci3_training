<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Calculator Module">
    <title>Calculator - <?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?></title>
    <link rel="icon" type="image/png" href="<?php echo base_url('assets/favicon.ico'); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .hero-section {
            background: linear-gradient(135deg, #a12124 0%, #343434 100%);
            color: white;
            padding: 60px 0;
        }
        .calculator-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            padding: 30px;
            margin-top: -50px;
        }
        .calculator-display {
            background: #f8f9fa;
            border: 2px solid #dee2e6;
            border-radius: 10px;
            padding: 20px;
            font-size: 2rem;
            text-align: right;
            font-family: 'Courier New', monospace;
            min-height: 80px;
            word-wrap: break-word;
            overflow-x: auto;
        }
        .calc-button {
            font-size: 1.25rem;
            padding: 20px;
            border: none;
            border-radius: 10px;
            transition: all 0.2s ease;
            font-weight: 500;
        }
        .calc-button:hover {
            transform: scale(1.05);
        }
        .calc-button:active {
            transform: scale(0.95);
        }
        .btn-number {
            background: #e9ecef;
            color: #343434;
        }
        .btn-number:hover {
            background: #d3d6d9;
        }
        .btn-operator {
            background: #a12124;
            color: white;
        }
        .btn-operator:hover {
            background: #861b1d;
        }
        .btn-function {
            background: #343434;
            color: white;
        }
        .btn-function:hover {
            background: #1a1a1a;
        }
        .btn-equals {
            background: linear-gradient(135deg, #a12124 0%, #343434 100%);
            color: white;
        }
        .btn-equals:hover {
            opacity: 0.9;
        }
        .btn-clear {
            background: #dc3545;
            color: white;
        }
        .btn-clear:hover {
            background: #c82333;
        }
        .calculator-tabs .nav-link {
            color: #6c757d;
            font-weight: 500;
            border-radius: 10px;
        }
        .calculator-tabs .nav-link.active {
            background: linear-gradient(135deg, #a12124 0%, #343434 100%);
            color: white;
        }
        .scientific-functions {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
            margin-bottom: 15px;
        }
        .history-item {
            padding: 10px;
            background: #f8f9fa;
            border-radius: 8px;
            margin-bottom: 8px;
            font-family: 'Courier New', monospace;
        }
        .navbar {
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="<?php echo base_url(); ?>">
                <img src="<?php echo base_url('assets/jrcsrg_transparent.png'); ?>" alt="Logo" height="35">
                Calculator
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="<?php echo base_url('training'); ?>"><i class="bi bi-arrow-left me-2"></i>Back to Training</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo base_url('portfolio'); ?>">Portfolio</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1 class="display-4 fw-bold mb-3"><i class="bi bi-calculator me-3"></i>Calculator Module</h1>
            <p class="lead mb-0">Standard and Scientific Calculator with History Tracking</p>
        </div>
    </section>

    <!-- Calculator Section -->
    <section class="pb-5">
        <div class="container">
            <div class="calculator-container">
                
                <!-- Calculator Tabs -->
                <ul class="nav nav-tabs calculator-tabs mb-4" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="standard-tab" data-bs-toggle="tab" data-bs-target="#standard" type="button" role="tab">
                            <i class="bi bi-calculator me-2"></i>Standard
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="scientific-tab" data-bs-toggle="tab" data-bs-target="#scientific" type="button" role="tab">
                            <i class="bi bi-calculator-fill me-2"></i>Scientific
                        </button>
                    </li>
                </ul>

                <div class="tab-content">
                    
                    <!-- Standard Calculator -->
                    <div class="tab-pane fade show active" id="standard" role="tabpanel">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="calculator-display mb-4" id="display-standard">0</div>
                                
                                <div class="row g-3">
                                    <div class="col-3">
                                        <button class="btn btn-clear calc-button w-100" onclick="clearCalc('standard')">C</button>
                                    </div>
                                    <div class="col-3">
                                        <button class="btn btn-function calc-button w-100" onclick="deleteLast('standard')">
                                            <i class="bi bi-backspace"></i>
                                        </button>
                                    </div>
                                    <div class="col-3">
                                        <button class="btn btn-operator calc-button w-100" onclick="appendOperator('%', 'standard')">%</button>
                                    </div>
                                    <div class="col-3">
                                        <button class="btn btn-operator calc-button w-100" onclick="appendOperator('/', 'standard')">/</button>
                                    </div>
                                </div>

                                <div class="row g-3 mt-1">
                                    <div class="col-3">
                                        <button class="btn btn-number calc-button w-100" onclick="appendNumber('7', 'standard')">7</button>
                                    </div>
                                    <div class="col-3">
                                        <button class="btn btn-number calc-button w-100" onclick="appendNumber('8', 'standard')">8</button>
                                    </div>
                                    <div class="col-3">
                                        <button class="btn btn-number calc-button w-100" onclick="appendNumber('9', 'standard')">9</button>
                                    </div>
                                    <div class="col-3">
                                        <button class="btn btn-operator calc-button w-100" onclick="appendOperator('*', 'standard')">×</button>
                                    </div>
                                </div>

                                <div class="row g-3 mt-1">
                                    <div class="col-3">
                                        <button class="btn btn-number calc-button w-100" onclick="appendNumber('4', 'standard')">4</button>
                                    </div>
                                    <div class="col-3">
                                        <button class="btn btn-number calc-button w-100" onclick="appendNumber('5', 'standard')">5</button>
                                    </div>
                                    <div class="col-3">
                                        <button class="btn btn-number calc-button w-100" onclick="appendNumber('6', 'standard')">6</button>
                                    </div>
                                    <div class="col-3">
                                        <button class="btn btn-operator calc-button w-100" onclick="appendOperator('-', 'standard')">−</button>
                                    </div>
                                </div>

                                <div class="row g-3 mt-1">
                                    <div class="col-3">
                                        <button class="btn btn-number calc-button w-100" onclick="appendNumber('1', 'standard')">1</button>
                                    </div>
                                    <div class="col-3">
                                        <button class="btn btn-number calc-button w-100" onclick="appendNumber('2', 'standard')">2</button>
                                    </div>
                                    <div class="col-3">
                                        <button class="btn btn-number calc-button w-100" onclick="appendNumber('3', 'standard')">3</button>
                                    </div>
                                    <div class="col-3">
                                        <button class="btn btn-operator calc-button w-100" onclick="appendOperator('+', 'standard')">+</button>
                                    </div>
                                </div>

                                <div class="row g-3 mt-1">
                                    <div class="col-6">
                                        <button class="btn btn-number calc-button w-100" onclick="appendNumber('0', 'standard')">0</button>
                                    </div>
                                    <div class="col-3">
                                        <button class="btn btn-number calc-button w-100" onclick="appendNumber('.', 'standard')">.</button>
                                    </div>
                                    <div class="col-3">
                                        <button class="btn btn-equals calc-button w-100" onclick="calculate('standard')">=</button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <h6 class="fw-bold mb-3"><i class="bi bi-clock-history me-2"></i>History</h6>
                                <div id="history-standard" style="max-height: 450px; overflow-y: auto;">
                                    <p class="text-muted text-center"><small>No calculations yet</small></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Scientific Calculator -->
                    <div class="tab-pane fade" id="scientific" role="tabpanel">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="calculator-display mb-4" id="display-scientific">0</div>
                                
                                <!-- Scientific Functions -->
                                <div class="scientific-functions">
                                    <button class="btn btn-function calc-button" onclick="scientificFunc('sin', 'scientific')">sin</button>
                                    <button class="btn btn-function calc-button" onclick="scientificFunc('cos', 'scientific')">cos</button>
                                    <button class="btn btn-function calc-button" onclick="scientificFunc('tan', 'scientific')">tan</button>
                                    <button class="btn btn-function calc-button" onclick="scientificFunc('log', 'scientific')">log</button>
                                    <button class="btn btn-function calc-button" onclick="scientificFunc('ln', 'scientific')">ln</button>
                                    <button class="btn btn-function calc-button" onclick="scientificFunc('sqrt', 'scientific')">√</button>
                                    <button class="btn btn-function calc-button" onclick="appendOperator('^', 'scientific')">x^y</button>
                                    <button class="btn btn-function calc-button" onclick="appendNumber('3.14159', 'scientific')">π</button>
                                </div>

                                <div class="row g-3">
                                    <div class="col-3">
                                        <button class="btn btn-clear calc-button w-100" onclick="clearCalc('scientific')">C</button>
                                    </div>
                                    <div class="col-3">
                                        <button class="btn btn-function calc-button w-100" onclick="deleteLast('scientific')">
                                            <i class="bi bi-backspace"></i>
                                        </button>
                                    </div>
                                    <div class="col-3">
                                        <button class="btn btn-operator calc-button w-100" onclick="appendOperator('%', 'scientific')">%</button>
                                    </div>
                                    <div class="col-3">
                                        <button class="btn btn-operator calc-button w-100" onclick="appendOperator('/', 'scientific')">/</button>
                                    </div>
                                </div>

                                <div class="row g-3 mt-1">
                                    <div class="col-3">
                                        <button class="btn btn-number calc-button w-100" onclick="appendNumber('7', 'scientific')">7</button>
                                    </div>
                                    <div class="col-3">
                                        <button class="btn btn-number calc-button w-100" onclick="appendNumber('8', 'scientific')">8</button>
                                    </div>
                                    <div class="col-3">
                                        <button class="btn btn-number calc-button w-100" onclick="appendNumber('9', 'scientific')">9</button>
                                    </div>
                                    <div class="col-3">
                                        <button class="btn btn-operator calc-button w-100" onclick="appendOperator('*', 'scientific')">×</button>
                                    </div>
                                </div>

                                <div class="row g-3 mt-1">
                                    <div class="col-3">
                                        <button class="btn btn-number calc-button w-100" onclick="appendNumber('4', 'scientific')">4</button>
                                    </div>
                                    <div class="col-3">
                                        <button class="btn btn-number calc-button w-100" onclick="appendNumber('5', 'scientific')">5</button>
                                    </div>
                                    <div class="col-3">
                                        <button class="btn btn-number calc-button w-100" onclick="appendNumber('6', 'scientific')">6</button>
                                    </div>
                                    <div class="col-3">
                                        <button class="btn btn-operator calc-button w-100" onclick="appendOperator('-', 'scientific')">−</button>
                                    </div>
                                </div>

                                <div class="row g-3 mt-1">
                                    <div class="col-3">
                                        <button class="btn btn-number calc-button w-100" onclick="appendNumber('1', 'scientific')">1</button>
                                    </div>
                                    <div class="col-3">
                                        <button class="btn btn-number calc-button w-100" onclick="appendNumber('2', 'scientific')">2</button>
                                    </div>
                                    <div class="col-3">
                                        <button class="btn btn-number calc-button w-100" onclick="appendNumber('3', 'scientific')">3</button>
                                    </div>
                                    <div class="col-3">
                                        <button class="btn btn-operator calc-button w-100" onclick="appendOperator('+', 'scientific')">+</button>
                                    </div>
                                </div>

                                <div class="row g-3 mt-1">
                                    <div class="col-3">
                                        <button class="btn btn-function calc-button w-100" onclick="appendOperator('(', 'scientific')">(</button>
                                    </div>
                                    <div class="col-3">
                                        <button class="btn btn-function calc-button w-100" onclick="appendOperator(')', 'scientific')">)</button>
                                    </div>
                                    <div class="col-3">
                                        <button class="btn btn-number calc-button w-100" onclick="appendNumber('.', 'scientific')">.</button>
                                    </div>
                                    <div class="col-3">
                                        <button class="btn btn-equals calc-button w-100" onclick="calculate('scientific')">=</button>
                                    </div>
                                </div>

                                <div class="row g-3 mt-1">
                                    <div class="col-12">
                                        <button class="btn btn-number calc-button w-100" onclick="appendNumber('0', 'scientific')">0</button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <h6 class="fw-bold mb-3"><i class="bi bi-clock-history me-2"></i>History</h6>
                                <div id="history-scientific" style="max-height: 550px; overflow-y: auto;">
                                    <p class="text-muted text-center"><small>No calculations yet</small></p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container text-center">
            <p class="mb-2">&copy; <?php echo date('Y'); ?> <?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?>. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let currentInput = {
            standard: '0',
            scientific: '0'
        };
        
        let history = {
            standard: [],
            scientific: []
        };

        function appendNumber(num, type) {
            // Sanitize: only allow digits and decimal point
            if (!/^[0-9.]$/.test(num) && num !== '3.14159') {
                return;
            }
            
            // Prevent multiple decimal points in the same number
            const lastNumber = currentInput[type].split(/[\+\-\*\/\%\^\(\)]/).pop();
            if (num === '.' && lastNumber.includes('.')) {
                return;
            }
            
            if (currentInput[type] === '0' && num !== '.') {
                currentInput[type] = num;
            } else {
                currentInput[type] += num;
            }
            updateDisplay(type);
        }

        function appendOperator(operator, type) {
            // Sanitize: only allow valid operators and parentheses
            if (!/^[\+\-\*\/\%\^\(\)]$/.test(operator)) {
                return;
            }
            
            // Prevent consecutive operators (except minus after another operator for negative numbers)
            const lastChar = currentInput[type].slice(-1);
            if (['+', '*', '/', '%', '^'].includes(lastChar) && ['+', '*', '/', '%', '^'].includes(operator)) {
                return; // Don't allow consecutive operators
            }
            
            currentInput[type] += operator;
            updateDisplay(type);
        }

        function clearCalc(type) {
            currentInput[type] = '0';
            updateDisplay(type);
        }

        function deleteLast(type) {
            if (currentInput[type].length > 1) {
                currentInput[type] = currentInput[type].slice(0, -1);
            } else {
                currentInput[type] = '0';
            }
            updateDisplay(type);
        }

        function updateDisplay(type) {
            document.getElementById('display-' + type).textContent = currentInput[type];
        }

        function scientificFunc(func, type) {
            // Whitelist of allowed scientific functions
            const allowedFunctions = ['sin', 'cos', 'tan', 'log', 'ln', 'sqrt'];
            
            if (!allowedFunctions.includes(func)) {
                console.error('Invalid function:', func);
                return;
            }
            
            let value = currentInput[type];
            
            // If display shows a number, apply function to it
            if (!isNaN(value) && value !== '0') {
                currentInput[type] = func + '(' + value + ')';
            } else {
                currentInput[type] += func + '(';
            }
            updateDisplay(type);
        }

        function calculate(type) {
            try {
                let expression = currentInput[type];
                
                // Replace display operators first
                expression = expression.replace(/×/g, '*').replace(/−/g, '-');
                
                // Handle scientific functions
                expression = expression.replace(/sin\(/g, 'Math.sin(');
                expression = expression.replace(/cos\(/g, 'Math.cos(');
                expression = expression.replace(/tan\(/g, 'Math.tan(');
                expression = expression.replace(/log\(/g, 'Math.log10(');
                expression = expression.replace(/ln\(/g, 'Math.log(');
                expression = expression.replace(/sqrt\(/g, 'Math.sqrt(');
                expression = expression.replace(/\^/g, '**');
                
                // Validate expression format (check for balanced parentheses)
                const openParens = (expression.match(/\(/g) || []).length;
                const closeParens = (expression.match(/\)/g) || []).length;
                if (openParens !== closeParens) {
                    throw new Error('Unbalanced parentheses');
                }
                
                // Validate only safe characters (numbers, operators, Math methods, parentheses)
                if (!/^[0-9+\-*/.()%\s]*$|Math\.(sin|cos|tan|log10|log|sqrt)/.test(expression)) {
                    // If expression contains Math methods or is basic arithmetic, allow it
                    const hasValidMath = /Math\.(sin|cos|tan|log10|log|sqrt)\(/.test(expression);
                    const hasBasicOnly = /^[0-9+\-*/.()%\s]+$/.test(expression);
                    
                    if (!hasValidMath && !hasBasicOnly) {
                        throw new Error('Invalid expression');
                    }
                }
                
                // Use Function constructor (input validation already done at source)
                const result = new Function('return ' + expression)();
                
                // Validate result is a finite number
                if (!isFinite(result)) {
                    throw new Error('Invalid result');
                }
                
                // Round to 10 decimal places to avoid floating point errors
                const roundedResult = Math.round(result * 10000000000) / 10000000000;
                
                // Add to history
                addToHistory(currentInput[type], roundedResult, type);
                
                currentInput[type] = roundedResult.toString();
                updateDisplay(type);
            } catch (error) {
                console.error('Calculation error:', error);
                currentInput[type] = 'Error';
                updateDisplay(type);
                setTimeout(() => {
                    currentInput[type] = '0';
                    updateDisplay(type);
                }, 1500);
            }
        }

        function addToHistory(expression, result, type) {
            history[type].unshift({
                expression: expression,
                result: result,
                timestamp: new Date().toLocaleTimeString()
            });
            
            // Keep only last 20 calculations
            if (history[type].length > 20) {
                history[type].pop();
            }
            
            updateHistory(type);
        }

        function updateHistory(type) {
            const historyDiv = document.getElementById('history-' + type);
            
            if (history[type].length === 0) {
                historyDiv.innerHTML = '<p class="text-muted text-center"><small>No calculations yet</small></p>';
                return;
            }
            
            let html = '';
            history[type].forEach(item => {
                html += `
                    <div class="history-item">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="flex-grow-1">
                                <div class="small text-muted">${item.expression}</div>
                                <div class="fw-bold text-success">= ${item.result}</div>
                            </div>
                            <small class="text-muted">${item.timestamp}</small>
                        </div>
                    </div>
                `;
            });
            
            historyDiv.innerHTML = html;
        }

        // Keyboard support with input validation
        document.addEventListener('keydown', function(event) {
            const activeTab = document.querySelector('.calculator-tabs .nav-link.active').id;
            const type = activeTab === 'standard-tab' ? 'standard' : 'scientific';
            
            // Only process valid calculator keys
            if (event.key >= '0' && event.key <= '9') {
                appendNumber(event.key, type);
            } else if (event.key === '.') {
                appendNumber('.', type);
            } else if (['+', '-', '*', '/', '%', '(', ')'].includes(event.key)) {
                appendOperator(event.key, type);
            } else if (event.key === 'Enter' || event.key === '=') {
                event.preventDefault();
                calculate(type);
            } else if (event.key === 'Backspace') {
                event.preventDefault();
                deleteLast(type);
            } else if (event.key === 'Escape' || event.key.toLowerCase() === 'c') {
                clearCalc(type);
            }
            // Ignore all other keys for security
        });
    </script>
</body>
</html>
