/*!

=========================================================
* Argon Dashboard Tailwind - v1.0.1
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard-tailwind
* Copyright 2022 Creative Tim (https://www.creative-tim.com)

* Coded by www.creative-tim.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

*/
var base_url = window.location.origin + '/'; // Get the base URL of the application
var page = window.location.pathname.split("/").pop().split(".")[0];
var aux = window.location.pathname.split("/");
var to_build = (aux.includes('pages') || aux.includes('docs') ?'../':'./');
var root = window.location.pathname.split("/")
if (!aux.includes("pages")) {
  page = "dashboard";
}

loadStylesheet(base_url + to_build + "myassets/css/perfect-scrollbar.css");
loadJS(base_url + to_build + "myassets/js/perfect-scrollbar.js", true);

if (document.querySelector("[slider]")) {
  loadJS(base_url + to_build + "myassets/js/carousel.js", true);
}

if (document.querySelector("nav [navbar-trigger]")) {
  loadJS(base_url + to_build + "myassets/js/navbar-collapse.js", true);
}

if (document.querySelector("[data-target='tooltip']")) {
  loadJS(base_url + to_build + "myassets/js/tooltips.js", true);
  loadStylesheet(base_url + to_build + "myassets/css/tooltips.css");
}

if (document.querySelector("[nav-pills]")) {
  loadJS(base_url + to_build + "myassets/js/nav-pills.js", true);
}

if (document.querySelector("[dropdown-trigger]")) {
  loadJS(base_url + to_build + "myassets/js/dropdown.js", true);

}

if (document.querySelector("[fixed-plugin]")) {
  loadJS(base_url + to_build + "myassets/js/fixed-plugin.js", true);
}

if (document.querySelector("[navbar-main]") || document.querySelector("[navbar-profile]")) {
  if(document.querySelector("[navbar-main]")){
    loadJS(base_url + to_build + "myassets/js/navbar-sticky.js", true);
  }
  if (document.querySelector("aside")) {
    loadJS(base_url + to_build + "myassets/js/sidenav-burger.js", true);
  }
}

if (document.querySelector("canvas")) {
  loadJS(base_url + to_build + "myassets/js/charts.js", true);
}

if (document.querySelector(".github-button")) {
  loadJS("https://buttons.github.io/buttons.js", true);
}


function loadJS(FILE_URL, async) {
  let dynamicScript = document.createElement("script");

  dynamicScript.setAttribute("src", FILE_URL);
  dynamicScript.setAttribute("type", "text/javascript");
  dynamicScript.setAttribute("async", async);

  document.head.appendChild(dynamicScript);
}

function loadStylesheet(FILE_URL) {
  let dynamicStylesheet = document.createElement("link");

  dynamicStylesheet.setAttribute("href", FILE_URL);
  dynamicStylesheet.setAttribute("type", "text/css");
  dynamicStylesheet.setAttribute("rel", "stylesheet");

  document.head.appendChild(dynamicStylesheet);
}
