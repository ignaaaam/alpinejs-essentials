<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Two way data binding</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/2.3.0/alpine.js" integrity="sha512-nIwdJlD5/vHj23CbO2iHCXtsqzdTTx3e3uAmpTm4x2Y8xCIFyWu4cSIV8GaGe2UNVq86/1h9EgUZy7tn243qdA==" crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>
</head>
<body class="p-10 max-w-lg mx-auto">
<form
    x-data="{
        form: {
        name: ''
    },

    user: null,

    submit(){
       fetch('https://reqres.in/api/useres', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(this.form)
       })
       .then(response => response.json())
       .then(user => this.user = user);
       }
    }"
    @submit.prevent="submit"
>
    <div class="mb-6">
            <label for="name" class="block mb-2 uppercase font-bold text-xs text-gray-700">
                Name
            </label>

            <input class="border border-gray-400 p-2 w-full rounded"
            type="text"
            name="name"
            id="name"
            required
            >
    </div>

    <template x-if="user">
        <div x-text="'The user ' + user.name + ' was created at ' + user.createdAt"></div>
    </template>

</form>

</body>
</html>
