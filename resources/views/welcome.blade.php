<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/2.3.0/alpine.js" integrity="sha512-nIwdJlD5/vHj23CbO2iHCXtsqzdTTx3e3uAmpTm4x2Y8xCIFyWu4cSIV8GaGe2UNVq86/1h9EgUZy7tn243qdA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <title>AlpineJS</title>
</head>
<body>
    <div x-data="game()" class="px-10 flex items-center justify-center min-h-screen">
        <h1 class="fixed top-0 right-0 p-10 font-bold text-3xl">
            <span x-text="points"></span>
            <span class="text-xs">pts</span>
        </h1>
        <div class="flex-1 grid grid-cols-4 gap-10">
            <template x-for="card in cards">
                <div>
                    <button x-show="! card.cleared"
                            :style="'background: ' + (card.flipped ? card.color : '#999')"
                            class="w-full h-32"
                            @click="flipCard(card)">

                    </button>
                </div>
            </template>
        </div>
    </div>

{{--    FLASH MESSAGE  --}}
    <div x-data="{show: false, message: 'Default message' }"
         x-show.transition.opacity="show"
         x-text="message"
         @flash.window="
         message = $event.detail.message;
         show = true;
         setTimeout(() => show = false, 1000)"
    class="fixed bottom-0 right-0 border border-green-500 bg-green-400 text-white p-4 m-4 rounded-lg">
    </div>

    <script>

        function pause(milliseconds = 1000) {
            return new Promise(resolve => setTimeout(resolve, milliseconds));
        }

        function flash(message) {
            window.dispatchEvent(new CustomEvent('flash', {
                detail: {message}
            }));
        }

        function game() {
            return {
                cards: [
                    { color: 'green', flipped: false, cleared: false },
                    { color: 'red', flipped: false, cleared: false },
                    { color: 'blue', flipped: false, cleared: false },
                    { color: 'yellow', flipped: false, cleared: false },
                    { color: 'green', flipped: false, cleared: false },
                    { color: 'red', flipped: false, cleared: false },
                    { color: 'blue', flipped: false, cleared: false },
                    { color: 'yellow', flipped: false, cleared: false },
                ].sort(() => Math.random() - .5),

                get flippedCards() {
                    return this.cards.filter(card => card.flipped);
                },

                get clearedCards() {
                    return this.cards.filter(card => card.cleared);
                },

                get remainingCards() {
                    return this.cards.filter(card => ! card.cleared);
                },

                get points(){
                  return this.clearedCards.length;
                },



                async flipCard(card) {
                    if (this.flippedCards.length == 2) {
                        return;
                    }
                    card.flipped = ! card.flipped;

                   if(this.flippedCards.length === 2) {
                       if (this.hasMatch()) {
                           flash('You found a match!');
                           await pause();

                           this.flippedCards.forEach(card => card.cleared = true);

                           // is the game over?
                           if(! this.remainingCards.length){
                               alert('You won!');
                           }
                       }

                       await pause();

                       this.flippedCards.forEach(card => card.flipped = false);
                   }
                },

                hasMatch() {
                    return this.flippedCards[0]['color'] === this.flippedCards[1]['color'];
                }
            };
        }
    </script>
</body>
</html>
