<style>
    /* From Uiverse.io by Nawsome */
    @keyframes clockwise-loader {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    @keyframes counter-clockwise-loader {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(-360deg);
        }
    }

    .hidden-loader {
        display: none !important;
    }

    .gearbox-loader {
        background: #111;
        height: 150px;
        width: 200px;
        position: fixed;
        /* Fijar el loader */
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        /* Centrar el loader */
        border: none;
        overflow: hidden;
        border-radius: 6px;
        box-shadow: 0px 0px 0px 1px rgba(255, 255, 255, 0.1);
        z-index: 1000;
        /* Asegurar que el loader se muestra encima de otros elementos */
    }

    .gearbox-loader .overlay-loader {
        border-radius: 6px;
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 10;
        box-shadow: inset 0px 0px 20px black;
        transition: background 0.2s;
        background: transparent;
    }

    .gear-loader {
        position: absolute;
        height: 60px;
        width: 60px;
        box-shadow: 0px -1px 0px 0px #888888, 0px 1px 0px 0px black;
        border-radius: 30px;
    }

    .gear-loader.large-loader {
        height: 120px;
        width: 120px;
        border-radius: 60px;
    }

    .gear-loader.large-loader:after {
        height: 96px;
        width: 96px;
        border-radius: 48px;
        margin-left: -48px;
        margin-top: -48px;
    }

    .gear-loader.one-loader {
        top: 12px;
        left: 10px;
    }

    .gear-loader.two-loader {
        top: 61px;
        left: 60px;
    }

    .gear-loader.three-loader {
        top: 110px;
        left: 10px;
    }

    .gear-loader.four-loader {
        top: 13px;
        left: 128px;
    }

    .gear-loader:after {
        content: "";
        position: absolute;
        height: 36px;
        width: 36px;
        border-radius: 36px;
        background: #111;
        top: 50%;
        left: 50%;
        margin-left: -18px;
        margin-top: -18px;
        z-index: 3;
        box-shadow: 0px 0px 10px rgba(255, 255, 255, 0.1), inset 0px 0px 10px rgba(0, 0, 0, 0.1), inset 0px 2px 0px 0px #090909, inset 0px -1px 0px 0px #888888;
    }

    .gear-inner-loader {
        position: relative;
        height: 100%;
        width: 100%;
        background: #555;
        border-radius: 30px;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .large-loader .gear-inner-loader {
        border-radius: 60px;
    }

    .gear-loader.one-loader .gear-inner-loader {
        animation: counter-clockwise-loader 3s infinite linear;
    }

    .gear-loader.two-loader .gear-inner-loader {
        animation: clockwise-loader 3s infinite linear;
    }

    .gear-loader.three-loader .gear-inner-loader {
        animation: counter-clockwise-loader 3s infinite linear;
    }

    .gear-loader.four-loader .gear-inner-loader {
        animation: counter-clockwise-loader 6s infinite linear;
    }

    .gear-inner-loader .bar-loader {
        background: #555;
        height: 16px;
        width: 76px;
        position: absolute;
        left: 50%;
        margin-left: -38px;
        top: 50%;
        margin-top: -8px;
        border-radius: 2px;
        border-left: 1px solid rgba(255, 255, 255, 0.1);
        border-right: 1px solid rgba(255, 255, 255, 0.1);
    }

    .large-loader .gear-inner-loader .bar-loader {
        margin-left: -68px;
        width: 136px;
    }

    .gear-inner-loader .bar-loader:nth-child(2) {
        transform: rotate(60deg);
    }

    .gear-inner-loader .bar-loader:nth-child(3) {
        transform: rotate(120deg);
    }

    .gear-inner-loader .bar-loader:nth-child(4) {
        transform: rotate(90deg);
    }

    .gear-inner-loader .bar-loader:nth-child(5) {
        transform: rotate(30deg);
    }

    .gear-inner-loader .bar-loader:nth-child(6) {
        transform: rotate(150deg);
    }
    
    body.loading-screen {
        overflow: hidden;
    }
    
    #loading-screen {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background-color: rgba(0, 0, 0, 0.7);
        z-index: 9999;
        display: flex;
        justify-content: center;
        align-items: center;
        pointer-events: all;
    }
</style>


<!-- From Uiverse.io by Nawsome -->
<div id="loading-screen" class="hidden-loader">
    <div class="gearbox-loader">
        <div class="overlay-loader"></div>
        <div class="gear-loader one-loader">
            <div class="gear-inner-loader">
                <div class="bar-loader"></div>
                <div class="bar-loader"></div>
                <div class="bar-loader"></div>
            </div>
        </div>
        <div class="gear-loader two-loader">
            <div class="gear-inner-loader">
                <div class="bar-loader"></div>
                <div class="bar-loader"></div>
                <div class="bar-loader"></div>
            </div>
        </div>
        <div class="gear-loader three-loader">
            <div class="gear-inner-loader">
                <div class="bar-loader"></div>
                <div class="bar-loader"></div>
                <div class="bar-loader"></div>
            </div>
        </div>
        <div class="gear-loader four-loader large-loader">
            <div class="gear-inner-loader">
                <div class="bar-loader"></div>
                <div class="bar-loader"></div>
                <div class="bar-loader"></div>
                <div class="bar-loader"></div>
                <div class="bar-loader"></div>
                <div class="bar-loader"></div>
            </div>
        </div>
    </div>
</div>

<script>
    function showLoader() {
        document.getElementById('loading-screen').classList.remove('hidden-loader');
        document.body.classList.add('loading-screen');
    }

    function hideLoader() {
        document.getElementById('loading-screen').classList.add('hidden-loader');
        document.body.classList.remove('loading-screen');
    }

    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function() {
                showLoader();
            });
        });
    });

    // Ejemplo para probar:
    // showLoader();
</script>
