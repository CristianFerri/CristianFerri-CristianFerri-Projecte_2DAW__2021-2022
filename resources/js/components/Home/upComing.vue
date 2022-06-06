<template>
  <div class="upComing">
    <h1>Pronto en cines</h1>
    <VueSlickCarousel v-bind="settings" v-if="movies.length > 0" class="slider">
      <div class="movie" v-for="(movie, i) in movies" :key="i">
        <img v-bind:src="movie.poster_path" v-bind:alt="movie.title">
        <h4>{{ movie.title }}</h4>
        <p>{{ movie.overview }}</p>
        <i>{{ movie.release_date }}</i>
      </div>
    </VueSlickCarousel>
  </div>
</template>

<script>
import VueSlickCarousel from 'vue-slick-carousel';
import 'vue-slick-carousel/dist/vue-slick-carousel.css';
import 'vue-slick-carousel/dist/vue-slick-carousel-theme.css';

import axios from 'axios';

export default {
  name: 'MyComponent',
  components: { VueSlickCarousel },
  data() {
    return {
      movies: [],
      movie: {},
      settings: {
        "dots": true,
        "infinite": false,
        "speed": 500,
        "slidesToShow": 4,
        "slidesToScroll": 4,
        "initialSlide": 0,
        "responsive": [
          {
            "breakpoint": 1025,
            "settings": {
              "slidesToShow": 3,
              "slidesToScroll": 3,
              "infinite": true,
              "dots": true
            }
          },
          {
            "breakpoint": 768,
            "settings": {
              "slidesToShow": 2,
              "slidesToScroll": 2,
              "infinite": true,
              "dots": true
            }
          },
          {
            "breakpoint": 600,
            "settings": {
              "slidesToShow": 1,
              "slidesToScroll": 1,
              "dots": false
            }
          },
          {
            "breakpoint": 480,
            "settings": {
              "slidesToShow": 1,
              "slidesToScroll": 1,
              "dots": false
            }
          }
        ]
      },
    }
  },

  mounted() {
    this.getMovies();
  },

  methods: {
    async getMovies() {
      try {
        let response = await axios.get('https://api.themoviedb.org/3/movie/upcoming?api_key=4475c14c3e095c6c8e3ca8d00f5070d5&language=es')
          .then(response => response.data)
          .catch(function () {
          })
        for (let i = 0; response.results.length; i++) {
          this.movie = {
            title: response.results[i].title,
            overview: response.results[i].overview,
            poster_path: 'https://image.tmdb.org/t/p/w500' + response.results[i].poster_path,
            release_date: response.results[i].release_date
          }
          this.movies.push(this.movie);
        }
      } catch (e) {
      }
    },
  }
}
</script>

<style type="text/css">
@import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@400;700&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Koulen&display=swap');

.slick-list {margin: 0 -20px;}
.slick-slide>div {padding: 0 20px;}

.upComing h1 {
  font-family: 'Koulen', cursive;
  font-weight: bolder;
  color: #fff;
}

.slick-track {
  display: flex;
}

.slick-track .slick-slide {
  display: flex;
  height: auto;
  align-items: center;
  justify-content: center;
}

.slick-next::before {
  color: #fff;
  font-size: 60px;
  position: relative;
  right: 40px;
}

.slick-prev::before {
  color: #fff;
  font-size: 60px;
}

.slick-prev {
  z-index: 1;
}

.slider {
  margin-bottom: 150px;
}

.movie {
  transition: all .5s ease-in-out;
  cursor: pointer;
}

.movie:hover {
  transform: scale(1.1);
}

.movie:hover i,
.movie:hover p,
.movie:hover h4 {
  opacity: 1;
}

.movie>img {
  transition: all .5s ease-in-out;
  width: 100%;
  height: 510px;
  overflow: hidden;
}

.movie:hover img {
  filter: brightness(25%);
}

.movie i,
.movie p,
.movie h4 {
  color: #fff;
  font-family: 'Quicksand', sans-serif;
  font-size: 1rem;
  position: absolute;
  left: 20px;
  opacity: 0;
  text-align: justify;
  max-width: 89%;
  max-height: 70%;
  overflow: hidden;
  transition: all .5s ease-in-out;

}

.movie>i {
  font-style: normal;
  font-size: .8rem;
  top: 12%;
  left: 20px;
}

.movie>p {
  top: 20%;
  left: 20px;
  font-size: .9rem;

}

.movie>h4 {
  top: 5%;
  font-weight: bold;
  left: 20px;
}

@media (max-width: 1024px) {
  .movie p {
    max-height: 85%;
  }
}

@media (max-width: 600px) {
  .movie img {
    width: auto;
    margin: auto;
  }

  .movie > i, .movie p, .movie h4 {
    left: 80px;
    max-width: 65%;
  }

  .movie > h4 {
    top: 6%;
  }
}

@media (max-width: 480px) {
  .movie > i, .movie p, .movie h4 {
    left: 15;
    max-width: 90%;
  }
}
</style>
