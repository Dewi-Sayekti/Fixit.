<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FIXIT - Login</title>

    <!-- Load Fonts -->
    <style>
        @font-face {
            font-family: 'Brigends';
            src: url('/fonts/BrigendsExpanded.otf') format('opentype');
        }

        @font-face {
            font-family: 'Graphite';
            src: url('/fonts/GraphiteDEMO.otf') format('opentype');
        }

        body {
            margin: 0;
            padding: 0;
            background: #102B57; /* warna biru Figma */
            font-family: 'Graphite', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            height: 100vh;
            overflow: hidden;
        }

        .cindo{
            width: 20%;
    /* max-width: 720px; */
        }

        .container {
            text-align: center;
            color: white;
            width: 100%;
            max-width: 420px;
        }

        .logo {
            font-family: 'Brigends', sans-serif;
            font-size: 48px;
            letter-spacing: 2px;
            margin-bottom: 40px;
        }

        .input-field {
            width: 100%;
            background: white;
            border: none;
            padding: 14px 20px;
            border-radius: 30px;
            margin-bottom: 18px;
            font-size: 16px;
            text-align: center;
            font-family: 'Graphite', sans-serif;
            outline: none;
            /* tambahan untuk konsistensi */
            display: flex;
            justify-content: center;
            align-items: center;
            box-sizing: border-box;
            line-height: 1.4;   /* samakan line-height */
        }

        input.input-field {
        text-align: center;   /* pastikan teks di tengah */
        height: 50px;         /* samakan tinggi dengan select */
        }

        .dropdown {
            appearance: none;
            background: white url('data:image/svg+xml;utf8,<svg width="14" height="14" xmlns="http://www.w3.org/2000/svg"><polyline points="1,4 7,10 13,4" stroke="%23000" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/></svg>') no-repeat right 20px center;
            background-size: 16px;
        }

        .btn-login {
            padding: 10px 40px;
            background: transparent;
            border: 1.6px solid white;
            color: white;
            border-radius: 30px;
            cursor: pointer;
            margin-top: 10px;
            font-size: 16px;
            font-family: 'Graphite', sans-serif;
        }

        .btn-login:hover {
            opacity: 0.7;
        }

        .bottom-signin {
            position: absolute;
            bottom: 40px;
            left: 0;
            right: 0;
            text-align: center;
        }

        .bottom-signin button {
            padding: 10px 40px;
            background: transparent;
            border: 1.6px solid rgba(255,255,255,0.6);
            color: rgba(255,255,255,0.6);
            border-radius: 30px;
            cursor: pointer;
            font-family: 'Graphite', sans-serif;
        }
    </style>

</head>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        let mode = "login"; // default

        const form = document.getElementById("authForm");
        const submitBtn = document.getElementById("submitBtn");
        const switchBtn = document.getElementById("switchModeBtn");

        switchBtn.addEventListener("click", () => {

            if (mode === "login") {
                // ganti ke REGISTER
                mode = "register";
                form.action = "<?php echo e(route('register.process')); ?>";
                submitBtn.textContent = "sign in";
                switchBtn.textContent = "log in";

            } else {
                // kembali ke LOGIN
                mode = "login";
                form.action = "<?php echo e(route('login.process')); ?>";
                submitBtn.textContent = "log in";
                switchBtn.textContent = "sign in";
            }
        });
    });
</script>


<body>

    <div class="container">
        <!-- LOGO -->
        <div class="logo">FIXIT.</div>

        <!-- FORM LOGIN -->
        <form id="authForm" action="<?php echo e(route('login.process')); ?>" method="POST">

            <?php echo csrf_field(); ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>
       <div style="color:#ffb3b3; margin-bottom:15px;">
           <?php echo e($errors->first()); ?>

       </div>
   <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <input type="text" name="username" placeholder="username" class="input-field">

            <input type="password" name="password" placeholder="password" class="input-field">

            <select name="role" class="input-field dropdown">
                <option value="santri">santri</option>
                <option value="staf">staf</option>
            </select>

            <button type="submit" id="submitBtn" class="btn-login">log in</button>

        </form>

        <!-- BOTTOM SIGN IN -->
        <div class="bottom-signin">
            <button id="switchModeBtn" type="button">sign in</button>
        </div>
        

    </div>

</body>
</html>
<?php /**PATH C:\Users\Tiara Mustika\Downloads\fixit\resources\views/login.blade.php ENDPATH**/ ?>