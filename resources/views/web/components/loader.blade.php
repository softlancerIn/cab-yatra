<style>
    .lodar_box {
        width: 100%;
        height: 100vh;
        backdrop-filter: blur(3px);
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 999;

    }

    .spin {

        box-sizing: border-box;
        display: block;
        height: 100px;
        width: 100px;
        border: 5px solid #c9c7c7;
        border-top: 10px solid #00A743;
        border-radius: 50%;
        -webkit-animation: loader-2-spin 0.5s linear infinite;
        animation: loader-2-spin 0.5s linear infinite;
    }

    @-webkit-keyframes loader-2-spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    @keyframes loader-2-spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    /*  modal loader #00A743 */

    .modal_loader_box {
        width: 100%;
        height: 100vh;
        backdrop-filter: blur(3px);
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 9999;

    }

    .modal_spin {

        box-sizing: border-box;
        display: block;
        height: 100px;
        width: 100px;
        border: 5px solid #c9c7c7;
        border-top: 10px solid #00A743;
        border-radius: 50%;
        -webkit-animation: modal_loader-2-spin 0.5s linear infinite;
        animation: modal_loader-2-spin 0.5s linear infinite;
    }

    @-webkit-keyframes modal_loader-2-spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    @keyframes modal_loader-2-spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>
<div class="lodar_box d-flex align-items-center justify-content-center d-none">
    <div class="spin"></div>
</div>

<div class="modal_loader_box d-flex align-items-center justify-content-center d-none">
    <div class="modal_spin"></div>
</div>