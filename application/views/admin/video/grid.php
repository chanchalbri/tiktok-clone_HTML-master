<style>

body {
  font-family: sans-serif;
  line-height: 1.4;
  font-size: 18px;
  padding: 20px;
  max-width: 640px;
  margin: 0 auto;
}

.grid {
  max-width: 1200px;
}

/* reveal grid after images loaded */
.grid.are-images-unloaded {
  /* opacity: 0; */
}

.grid__item,
.grid__col-sizer {
  width: 32%;
}

.grid__gutter-sizer { width: 2%; }

/* hide by default */
.grid.are-images-unloaded .image-grid__item {
  opacity: 0;
}

.grid__item {
  margin-bottom: 20px;
  float: left;
}

.grid__item--height1 { height: 140px; background: #EA0; }
.grid__item--height2 { height: 220px; background: #C25; }
.grid__item--height3 { height: 300px; background: #19F; }

.grid__item--width2 { width: 66%; }

.grid__item img {
  display: block;
  max-width: 100%;
}


.page-load-status {
  display: none; /* hidden by default */
  padding-top: 20px;
  border-top: 1px solid #DDD;
  text-align: center;
  color: #777;
}

/* loader ellips in separate pen CSS */

</style>
<h1>Infinite Scroll - Masonry image grid</h1>

<div class="grid are-images-unloaded">
  <div class="grid__col-sizer"></div>
  <div class="grid__gutter-sizer"></div>
  <div class="grid__item grid__item--height2"></div>
  <div class="grid__item grid__item--width2">
    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/orange-tree.jpg" alt="orange tree" />
  </div>
  <div class="grid__item grid__item--height3"></div>
  <div class="grid__item grid__item--height1"></div>
  <div class="grid__item grid__item--height2"></div>
  <div class="grid__item">
    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/look-out.jpg" alt="look out" />
  </div>

  <div class="grid__item grid__item--height1"></div>
  <div class="grid__item grid__item--height3"></div>
  <div class="grid__item grid__item--height1"></div>
  <div class="grid__item grid__item--height3"></div>
  <div class="grid__item grid__item--height1"></div>
  <div class="grid__item grid__item--height1"></div>
  <div class="grid__item grid__item--width2">
    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/raspberries.jpg" alt="rasberries" />
  </div>
  <div class="grid__item grid__item--height2"></div>
  <div class="grid__item grid__item--height2"></div>
  <div class="grid__item grid__item--height3"></div>
  <div class="grid__item grid__item--height1"></div>
  <div class="grid__item grid__item--height2"></div>
</div>

<div class="page-load-status">
  <div class="loader-ellips infinite-scroll-request">
    <span class="loader-ellips__dot"></span>
    <span class="loader-ellips__dot"></span>
    <span class="loader-ellips__dot"></span>
    <span class="loader-ellips__dot"></span>
  </div>
  <p class="infinite-scroll-last">End of content</p>
  <p class="infinite-scroll-error">No more pages to load</p>
</div>
<script src="<?= BASE_URL ?>assets/js/masonry.pkgd.min.js"></script>
<script src="https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.js"></script>
<script src="https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js"></script>
<script type="text/javascript">
//-------------------------------------//

var grid = document.querySelector('.grid');

var msnry = new Masonry( grid, {
  itemSelector: 'none', // select none at first
  columnWidth: '.grid__col-sizer',
  gutter: '.grid__gutter-sizer',
  percentPosition: true,
  stagger: 30,
  // nicer reveal transition
  visibleStyle: { transform: 'translateY(0)', opacity: 1 },
  hiddenStyle: { transform: 'translateY(100px)', opacity: 0 },
});


// initial items reveal
imagesLoaded( grid, function() {
  grid.classList.remove('are-images-unloaded');
  msnry.options.itemSelector = '.grid__item';
  var items = grid.querySelectorAll('.grid__item');
  msnry.appended( items );
});

//-------------------------------------//
// hack CodePen to load pens as pages

var nextPenSlugs = [
  '202252c2f5f192688dada252913ccf13',
  'a308f05af22690139e9a2bc655bfe3ee',
  '6c9ff23039157ee37b3ab982245eef28',
];

function getPenPath() {
  var slug = nextPenSlugs[ this.loadCount ];
  return 'https://s.codepen.io/desandro/debug/' + slug;
}

//-------------------------------------//
// init Infinte Scroll

var infScroll = new InfiniteScroll( grid, {
  path: getPenPath,
  append: '.grid__item',
  outlayer: msnry,
  status: '.page-load-status',
});

var InfiniteScroll = require('infinite-scroll');

var infScroll = new InfiniteScroll('.container', {
  // options
  path: ".pagination__next",
  append: ".post",
  history: false
});

</script>