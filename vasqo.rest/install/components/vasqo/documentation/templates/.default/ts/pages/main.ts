import Alpine from "alpinejs";
import hljs from 'highlight.js';
import "highlight.js/styles/github.css";
import php from "highlight.js/lib/languages/php";

Alpine.data("docspage", ()=>({
    init() : void {
        console.log("WORK");
        hljs.registerLanguage("php", php);
        hljs.configure({cssSelector: "code"});
        hljs.highlightAll();
    }
}));

Alpine.start();