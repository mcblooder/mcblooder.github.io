'use strict';
const CACHE_NAME = 'flutter-app-cache';
const RESOURCES = {
  "index.html": "2c89a5d8f5b59faa1a47718fb251b9ed",
"/": "2c89a5d8f5b59faa1a47718fb251b9ed",
"main.dart.js": "8c4d27ffcfc1e521e8fe6f42d32db807",
"favicon.png": "5dcef449791fa27946b3d35ad8803796",
"icons/Icon-192.png": "ac9a721a12bbc803b44f645561ecb1e1",
"icons/Icon-512.png": "96e752610906ba2a93c65f8abe1645f1",
"manifest.json": "ac3d3017a7de497a8f918cb4bb8932d7",
"assets/LICENSE": "d4cd7baff5345ae81ed364b665d0f612",
"assets/AssetManifest.json": "19376166f128b094834a2d8582653961",
"assets/FontManifest.json": "fc80ae63a76ab45eca4433dfe6a3ca96",
"assets/packages/cupertino_icons/assets/CupertinoIcons.ttf": "115e937bb829a890521f72d2e664b632",
"assets/fonts/SF-Pro-Display-Semibold.ttf": "994f77d480a6121135c8cfa36f7bdc28",
"assets/fonts/SF-Pro-Display-Regular.ttf": "8e3d0455129471f738313da48d3f3fa6",
"assets/fonts/MaterialIcons-Regular.ttf": "56d3ffdef7a25659eab6a68a3fbfaf16"
};

self.addEventListener('activate', function (event) {
  event.waitUntil(
    caches.keys().then(function (cacheName) {
      return caches.delete(cacheName);
    }).then(function (_) {
      return caches.open(CACHE_NAME);
    }).then(function (cache) {
      return cache.addAll(Object.keys(RESOURCES));
    })
  );
});

self.addEventListener('fetch', function (event) {
  event.respondWith(
    caches.match(event.request)
      .then(function (response) {
        if (response) {
          return response;
        }
        return fetch(event.request);
      })
  );
});
