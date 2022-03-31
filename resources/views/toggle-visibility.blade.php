<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Toggle Visiblity</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/2.3.0/alpine.js" integrity="sha512-nIwdJlD5/vHj23CbO2iHCXtsqzdTTx3e3uAmpTm4x2Y8xCIFyWu4cSIV8GaGe2UNVq86/1h9EgUZy7tn243qdA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<style>
    .active {
        color: blue;
    }
</style>
<body>

<div x-data="{currentTab: 'second'}">
    <button @click="currentTab = 'first'" :class="{ 'active' : currentTab === 'first'}">First</button>
    <button @click="currentTab = 'second'" :class="{ 'active' : currentTab === 'second'}">Second</button>
    <button @click="currentTab = 'third'" :class="{ 'active' : currentTab === 'third'}">Third</button>

    <div style="border: 1px dotted grey; padding: 1rem;">
        <div x-show="currentTab === 'first'">
            <p>First tab.</p>
        </div>
        <div x-show="currentTab === 'second'">
            <p>Second tab.</p>
        </div>
        <div x-show="currentTab === 'third'">
            <p>Third tab.</p>
        </div>
    </div>
</div>

{{--<div x-data="{ show: false}">
    <h1 x-show="show">Hello World</h1>--}}

    {{--    <button @click="show = ! show" x-text="show ? 'Hide' : 'Show'"></button>

      <div x-show="show">--}}
{{--        <a href="/" style="display: block">Home</a>--}}
{{--        <a href="/" style="display: block">About</a>--}}
{{--        <a href="/" style="display: block">Contact</a>--}}
{{--    </div>
</div>--}}
</body>
</html>
