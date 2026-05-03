<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre Code de Réduction TECHGAME</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #020c06;
            color: #ffffff;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #041a0d;
            padding: 40px 20px;
            border-top: 4px solid #39ff14;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo {
            font-size: 28px;
            font-weight: bold;
            color: #ffffff;
            text-decoration: none;
            letter-spacing: 2px;
        }
        .logo span {
            color: #39ff14;
        }
        .content {
            background-color: #062615;
            padding: 30px;
            border-radius: 8px;
            border: 1px solid rgba(57, 255, 20, 0.2);
            text-align: center;
        }
        h1 {
            color: #ffffff;
            font-size: 24px;
            margin-top: 0;
        }
        p {
            font-size: 16px;
            line-height: 1.5;
            color: #b3b3b3;
        }
        .promo-box {
            background-color: rgba(57, 255, 20, 0.1);
            border: 2px dashed #39ff14;
            padding: 20px;
            margin: 30px 0;
            border-radius: 8px;
        }
        .promo-code {
            font-size: 32px;
            font-weight: bold;
            color: #39ff14;
            letter-spacing: 4px;
            margin: 0;
        }
        .btn {
            display: inline-block;
            background-color: #39ff14;
            color: #ffffff;
            text-decoration: none;
            padding: 15px 30px;
            font-weight: bold;
            border-radius: 4px;
            margin-top: 20px;
            font-size: 16px;
        }
        .footer {
            text-align: center;
            margin-top: 40px;
            font-size: 12px;
            color: #666666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header" style="display: flex; align-items: center; justify-content: center; gap: 10px;">
            <img src="{{ $message->embed(public_path('circle_icon.png')) }}" alt="TechGame Logo" style="width: 32px; height: 32px; object-fit: contain; vertical-align: middle;">
            <h2 style="display: inline-block; margin: 0; vertical-align: middle; color: #39ff14; font-family: 'Orbitron', sans-serif;">TECHGAME</h2>
        </div>
        
        <div class="content">
            <h1>Bienvenue dans l'Élite !</h1>
            <p>Merci de rejoindre notre communauté. Comme promis, voici votre passe d'accès pour obtenir le meilleur équipement gaming à un prix exclusif.</p>
            
            <div class="promo-box">
                <p style="margin-top:0; margin-bottom: 10px; color: #ffffff; font-size: 14px; text-transform: uppercase;">Votre code de réduction de 30%</p>
                <div class="promo-code">TECHGAME30</div>
            </div>
            
            <p>Appliquez ce code dans votre panier lors de votre prochaine commande pour débloquer votre réduction.</p>
            
            <a href="http://localhost:5173" class="btn" style="color: #ffffff;">ALLER SUR LA BOUTIQUE</a>
        </div>
        
        <div class="footer">
            &copy; {{ date('Y') }} TECHGAME. Tous droits réservés.<br>
            Cet email a été envoyé automatiquement, merci de ne pas y répondre.
        </div>
    </div>
</body>
</html>
