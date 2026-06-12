<?php
session_start();


$senha_real = "minhaSenha123";
$hash_senha = hash('sha256', $senha_real);


$mensagem = "";
$classe_mensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"];
    $senha = $_POST["senha"];
    
   
    $hash_informado = hash('sha256', $senha);
    
    
    if ($hash_informado === $hash_senha) {
        $_SESSION["autenticado"] = true;
        $_SESSION["usuario"] = $usuario;
        $mensagem = "✅ LOGIN REALIZADO COM SUCESSO!";
        $classe_mensagem = "sucesso";
    } else {
        $mensagem = "❌ SENHA INCORRETA! Tente novamente.";
        $classe_mensagem = "erro";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Login com Hash</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            padding: 40px;
            width: 400px;
        }
        
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
        
        .info-hash {
            background: #f0f0f0;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 12px;
            font-family: monospace;
            word-break: break-all;
        }
        
        .info-hash p {
            margin: 5px 0;
            color: #666;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-weight: bold;
        }
        
        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        
        input:focus {
            outline: none;
            border-color: #667eea;
        }
        
        button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: transform 0.2s;
        }
        
        button:hover {
            transform: translateY(-2px);
        }
        
        .mensagem {
            margin-top: 20px;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            font-weight: bold;
        }
        
        .sucesso {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .erro {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .demo-info {
            margin-top: 20px;
            padding: 15px;
            background: #e3f2fd;
            border-radius: 5px;
            font-size: 14px;
        }
        
        .demo-info h4 {
            margin-bottom: 10px;
            color: #1976d2;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>🔐 Sistema de Login</h2>
        
        <div class="info-hash">
            <p><strong>Hash da Senha (SHA-256):</strong></p>
            <p><?php echo $hash_senha; ?></p>
            <p><small>* Este hash está armazenado na variável</small></p>
        </div>
        
        <form method="POST" action="">
            <div class="form-group">
                <label>👤 Usuário:</label>
                <input type="text" name="usuario" required placeholder="Digite seu usuário">
            </div>
            
            <div class="form-group">
                <label>🔒 Senha:</label>
                <input type="password" name="senha" required placeholder="Digite sua senha">
            </div>
            
            <button type="submit">Entrar</button>
        </form>
        
        <?php if ($mensagem): ?>
            <div class="mensagem <?php echo $classe_mensagem; ?>">
                <?php echo $mensagem; ?>
            </div>
        <?php endif; ?>
        
        <div class="demo-info">
            <h4>📝 Informações para Teste:</h4>
            <p><strong>Usuário:</strong> qualquer nome (ex: admin)</p>
            <p><strong>Senha correta:</strong> <code>minhaSenha123</code></p>
            <p><strong>Funcionamento:</strong> A senha é convertida em hash usando SHA-256 e comparada com o hash armazenado.</p>
        </div>
    </div>
</body>
</html>