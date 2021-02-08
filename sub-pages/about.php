<!DOCTYPE html>
<html>
<style>
    <?php include 'about.css'; ?>
</style>

<head>
    <title>Metals Market Display</title>
    <!-- https://material.io/resources/icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <?php include '../components/header.php'; ?>
    <?php include '../components/sidebar.php'; ?>

    <div style="padding: 64px 10px 10px 10px;">
        <div class="about-div card">

            <div class="about-card card">
                <div style="font-size: 1.2em; text-align: center;">Site Info</div>
                <div class="about-info-card card">
                    <p>
                        Welcome to Metals Market Display. This website mostly exists for coin shops, pawn shops,
                        and other institutions to display live market data. Currently, this website will update
                        the metals prices every 5 minutes, though this may change in the future! This site is
                        meant to be used in full screen mode! You can get into that mode by pressing F11.
                    </p>
                    <p>
                        For now, this website is free to use. However, I may start charging for it in the future.
                        Click the "Charts" tab to see the market! If you have any questions or want to suggest a
                        change, feel free to email me at dalton.s.baker@gmail.com
                    </p>
                </div>
            </div>

            <div class="about-card card">
                <div style="font-size: 1.2em; flex: 1; text-align: center;">My Links</div>
                <a href="https://gitlab.com/dalton_baker" class="about-link-card card">
                    <i class="fa fa-gitlab"></i>&nbsp; Gitlab
                </a>
                <a href="https://github.com/dalton-baker" class="about-link-card card">
                    <i class="fa fa-github"></i>&nbsp; Github
                </a>
                <a href="https://www.linkedin.com/in/dalton-baker/" class="about-link-card card">
                    <i class="fa fa-linkedin"></i>&nbsp; LinkdIn
                </a>
            </div>

        </div>

        <div class="about-div card" style="flex-direction:column; align-items: center;">
            <div style="padding: 5px;">
                Feel free embed these into your own website. Use the code below them and just drop it right into your html.
            </div>
            <div style="flex-direction:row; align-items: center; display: flex; flex-wrap: wrap;">
                <div style="flex-direction:column; align-items: center; display: flex; flex: 1;">
                    <div style="margin: 10px;">
                        <iframe src="/embed/largename" style="height: 250px; width: 205px; border:none; border-radius: 5px;"></iframe>
                    </div>
                    <div class="code-card card">
                        <pre><code>&lt;iframe src="https://metalsmarketdisplay.com/embed/largename" style="height: 250px; width: 205px; border:none; border-radius: 5px;"&gt;&lt;/iframe&gt;</code></pre>
                    </div>
                </div>

                <div style="flex-direction:column; align-items: center; display: flex; flex: 1;">
                    <div style="margin: 10px;">
                        <iframe src="/embed/smallname" style="height: 250px; width: 205px; border:none; border-radius: 5px;"></iframe>
                    </div>
                    <div class="code-card card">
                        <pre><code>&lt;iframe src="https://metalsmarketdisplay.com/embed/smallname" style="height: 250px; width: 205px; border:none; border-radius: 5px;"&gt;&lt;/iframe&gt;</code></pre>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <footer class="footer">
        Here are my crypto addresses, if your into that sort of thing <br />
        BTC: 3D5ZMpqaN8fQwmgzvMtr5tHa1ycsxf14JU<br />
        LTC: MCL2LPf4yZ2EmjimyNvYyMbvYoCTUfrAjW<br />
        XRP: rw2ciyaNshpHe7bCHo4bRWq6pqqynnWKQg
    </footer>
</body>

</html>