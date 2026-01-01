    <?php
    // includes/loader.php
    ?>

    <!-- LOADING SCREEN -->
    <div id="loader">
        <img 
            src="<?= base_url('uploads/logo-gradient.png'); ?>" 
            alt="SmartStock Loading"
            class="loader-logo"
        >
    </div>

    <style>
    /* =========================
    LOADER STYLE (GLOBAL)
    ========================= */
    #loader {
        position: fixed;
        inset: 0;
        background:
            radial-gradient(circle at 20% 20%, #6ea8fe33, transparent 40%),
            radial-gradient(circle at 80% 80%, #6610f233, transparent 40%),
            linear-gradient(135deg, #0d6efd, #6610f2);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        transition: opacity .6s cubic-bezier(.4,0,.2,1),
                    visibility .6s cubic-bezier(.4,0,.2,1);

        /* 🔥 FIX PALING PENTING */
        pointer-events: none;
    }

    /* LOGO */
    .loader-logo {
        width: 120px;
        animation:
            spin 2.2s linear infinite,
            pulse 1.6s ease-in-out infinite;
        filter: drop-shadow(0 20px 40px rgba(0,0,0,.45));
    }

    /* ROTATE */
    @keyframes spin {
        from { transform: rotate(0deg); }
        to   { transform: rotate(360deg); }
    }

    /* PULSE */
    @keyframes pulse {
        0%,100% { transform: scale(1); }
        50%     { transform: scale(1.08); }
    }

    /* HIDE */
    #loader.hide {
        opacity: 0;
        visibility: hidden;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
        .loader-logo {
            width: 90px;
        }
    }
    </style>

    <script>
    /* =========================
    LOADER SCRIPT
    ========================= */
    document.body.classList.add('loading');

    window.addEventListener('load', function () {
        const loader = document.getElementById('loader');
        setTimeout(() => {
            loader.classList.add('hide');
            document.body.classList.remove('loading');
        }, 600);
    });
    </script>