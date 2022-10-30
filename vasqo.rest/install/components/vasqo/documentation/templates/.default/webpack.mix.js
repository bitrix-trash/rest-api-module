const mix = require("laravel-mix");

mix.ts("ts/pages/main.ts", "build/main.js")
    .postCss('css/pages/main.css', 'build/css/main.css', [
        require("tailwindcss"),
    ]);