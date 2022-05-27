<div>
    <style>
        .loader {
            /*border-top-color: #3498db;*/
            -webkit-animation: spinner 1.5s linear infinite;
            animation: spinner 1.5s linear infinite;
        }

        @-webkit-keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes spinner {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
    </style>

    <div class="m-5">
        <div class="loader ease-linear rounded-full border-8 border-gray-300 h-32 w-32 mx-auto"></div>
        <p class="text-xl font-bold mt-5"> Por favor aguarde... </p>
    </div>
</div>