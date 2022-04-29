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

<div class="fixed top-0 left-0 w-full h-full bg-black opacity-50 z-100"></div>
<div>
    <div class="absolute top-0 left-0 right-0 transition duration-150 ease-in-out mt-5 md:mt-20 md:mr-4">
        {{-- Modal Box --}}
        <div role="alert" class="container mx-auto w-11/12 md:w-96 max-w-lg">
            {{-- Modal Content --}}
            <div
                class="relative py-8 px-5 md:px-10 bg-zinc-200 dark:text-gray-200 dark:bg-zinc-900 shadow-md rounded
                border border-gray-400 text-center">
                {{-- Close Button --}}
                <button class="cursor-pointer absolute top-0 right-0 mt-4 mr-5 text-gray-400 hover:text-gray-600
                    transition duration-150 ease-in-out rounded focus:ring-2 focus:outline-none focus:ring-gray-600"
                        onclick="modalHandler()" aria-label="close modal" role="button">
                    {{-- Close Icon --}}
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="20"
                         height="20" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" fill="none"
                         stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z"/>
                        <line x1="18" y1="6" x2="6" y2="18"/>
                        <line x1="6" y1="6" x2="18" y2="18"/>
                    </svg>
                </button>
                {{-- Box Content --}}
                <div class="loader ease-linear rounded-full border-8 border-gray-300 h-32 w-32 mx-auto"></div>
                <p class="text-xl font-bold mt-5"> Por favor aguarde... </p>
            </div>
        </div>
    </div>
    <script>
        let modal = document.getElementById("modal");

        function modalHandler(val) {
            if (val) {
                fadeIn(modal);
            } else {
                fadeOut(modal);
            }
        }

        function fadeOut(el) {
            el.style.opacity = 1;
            (function fade() {
                if ((el.style.opacity -= 0.1) < 0) {
                    el.style.display = "none";
                } else {
                    requestAnimationFrame(fade);
                }
            })();
        }

        function fadeIn(el, display) {
            el.style.opacity = 0;
            el.style.display = display || "flex";
            (function fade() {
                let val = parseFloat(el.style.opacity);
                if (!((val += 0.2) > 1)) {
                    el.style.opacity = val;
                    requestAnimationFrame(fade);
                }
            })();
        }
    </script>
</div>
