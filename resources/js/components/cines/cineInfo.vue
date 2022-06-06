<template>
  <div class="cine">
    <loader object="#ff9633" color1="#ffffff" color2="#17fd3d" size="5" speed="2" bg="#343a40" disableScrolling="true"
      objectbg="#999793" opacity="80" name="circular" v-if="!getMoviesDone"></loader>
    <div class="cine-mainTitle">
      <h1 class="cine-mainTitle-text ms-5">
        {{ cine.nombre }} {{ cine.localidad }}
      </h1>
    </div>
    <div class="cine-mainInfo container" v-if="getMoviesDone">
      <h3 class="mb-4">Sesiones</h3>
      <div v-if="getMoviesDone && movies.length == 0">
        <pre>No hay ninguna pelicula listada en este cine, vuelve más tarde!</pre>
      </div>
      <div class="row">
        <div class="col-md-8">
          <div id="movie-card-list">
            <div class="movie-card" v-for="(m, i) in movies" :key="i"
              :style="{ 'background-image': 'url(' + m.poster + ')' }">
              <div class="movie-card__overlay"></div>
              <div class="movie-card__content">
                <div class="movie-card__header">
                  <h1 class="movie-card__title">{{ m.title }}</h1>
                  <h4 class="movie-card__info d-inline" v-for="(g, x) in m.genres" :key="x">{{ g.name }} </h4>
                </div>
                <p class="movie-card__desc">
                  {{ acortarReview(m.overview) }}
                </p>
                <div class="d-flex justify-content-between w-75">
                  <button class="btn btn-outline movie-card__button" type="button" @click="getSesiones(m.id)"><fa icon="eye" /> Ver sesiones</button>
                  <p class="movie-card__desc text-danger">
                    <fa icon="clock" /> {{ m.time }} min
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card-sl">
            <div class="card-image" v-if="setCoordsDone">
              <GmapMap :center="center" :zoom="16" map-type-id="terrain" style="width: 100%; height: 250px">
                <GmapMarker :key="index" v-for="(m, index) in markers" :position="m.position" :clickable="true"
                  :draggable="true" @click="center = m.position" />
              </GmapMap>
            </div>

            <div class="card-heading">
              {{ cine.nombre }} {{ cine.localidad }}
            </div>
            <div class="card-text">
              {{ cine.direccion }}
            </div>
            <div class="card-text">
              {{ cine.email }} - {{ cine.telefono }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
import axios from "axios";

export default {
  data() {
    return {
      movies: [],
      getMoviesDone: false,
      setCoordsDone: false,
      cine: {},
      center: {},
      markers: [],
    };
  },

  props: ["object"],

  async mounted() {
    this.cine = this.object[0];
    await this.getMoviesByCine(this.cine.id);
    this.center = {
      lat: parseFloat(this.cine.latitude),
      lng: parseFloat(this.cine.longitude)
    }
    this.markers.push({ position: this.center });
    this.setCoordsDone = true;
  },

  methods: {
    async getMoviesByCine(id) {
      try {
        let response = await axios
          .get(`http://ask4urticket.herokuapp.com/cine/x/pelicula/${id}`)
          .then((response) => response.data)
          .catch(function () {
          });

        for (let i = 0; i < response.length; i++) {
          await this.getMoviesFromApi(response[i].api_id)
        }

        this.getMoviesDone = true;

      } catch (e) {
      }
    },

    acortarReview(rev) {
      let text = '';
      for (let i = 0; i <= rev.length; i++) {
        if (text.length <= 90)
          text += rev[i];
        else {
          text += "...";
          break;
        }
      }

      return text;
    },

    async getMoviesFromApi(api_id) {
      try {
        let response = await axios.get(`https://api.themoviedb.org/3/movie/${api_id}?api_key=4475c14c3e095c6c8e3ca8d00f5070d5&language=es`)
          .then((response) => response.data)
          .catch(function () {
          })

        let movie = {
          id: response.id,
          genres: response.genres,
          time: response.runtime,
          title: response.title,
          overview: response.overview,
          poster: 'https://image.tmdb.org/t/p/w500' + response.poster_path
        }

        this.movies.push(movie);
      } catch (e) {
      }
    },

    async getSesiones(id) {
      window.location.href = `/cinemas/${this.cine.id}/movie/${id}`;
    }
  },
};
</script>

<style>
@import url("https://fonts.googleapis.com/css2?family=Anton&display=swap");
@import url("https://fonts.googleapis.com/css?family=Montserrat:300,400,700,800");

.cine-mainTitle {
  background-image: url(../../../images/cines-mainTitle.jpg);
  padding: 50px;
}

.cine-mainTitle-text {
  color: white;
  font-weight: bold;
  font-family: "Anton", sans-serif;
  letter-spacing: 5px;
  font-size: 3em;
  text-transform: uppercase;
}

@import url("https://fonts.googleapis.com/css?family=Montserrat:300,400,700,800");

.cine a {
  text-decoration: none;
}

.cine button {
  font-family: inherit;
  border: 0;
  cursor: pointer;
}

.cine button:focus {
  outline: 0;
}

.movie-card {
  background-size: auto;
  background-repeat: no-repeat;
  width: 100%;
  max-width: 800px;
  height: 100%;
  min-height: 300px;
  display: block;
  margin: 8vh auto;
  border-radius: 8px;
  box-shadow: 0px 8px 12px 0px rgba(0, 0, 0, 0.25);
  position: relative;
}

@media screen and (max-width: 800px) {
  .movie-card {
    width: 95%;
    max-width: 95%;
  }
}

@media screen and (max-width: 600px) {
  .movie-card {
    background-position: 50% 0%;
    background-size: cover;
    height: 400px;
  }
}

.movie-card[data-movie="Blade Runner"] {
  background-image: url(http://digitalspyuk.cdnds.net/15/47/1600x800/landscape-1447754794-harrison-ford-blade-runner.jpg);
}

.movie-card[data-movie="Back to the Future"] {
  background-image: url("http://www.blastr.com/sites/blastr/files/back-to-the-future-part-ii-original.jpg");
}

.movie-card[data-movie=Akira] {
  background-image: url("https://static1.squarespace.com/static/51b3dc8ee4b051b96ceb10de/t/58d86b3db3db2b57ce8f2986/1490578241899/?format=2500w");
}

.movie-card__overlay {
  width: 100%;
  height: 100%;
  border-radius: 8px;
  background: linear-gradient(to right, rgba(42, 159, 255, 0.2) 0%, #212120 60%, #212120 100%);
  background-blend-mode: multiply;
  position: absolute;
  top: 0;
  bottom: 0;
  right: 0;
  left: 0;
}

@media screen and (max-width: 600px) {
  .movie-card__overlay {
    background: linear-gradient(to bottom, rgba(42, 159, 255, 0.2) 0%, #212120 60%, #212120 100%);
  }
}

.movie-card__share {
  padding: 1em;
  display: inline-block;
  width: 100%;
  max-width: 130px;
}

@media screen and (max-width: 600px) {
  .movie-card__share {
    display: block;
    width: 100%;
  }
}

.movie-card__icon {
  color: #ffffff;
  mix-blend-mode: lighten;
  opacity: 0.4;
  background: none;
  padding: 0;
}

.movie-card__icon:hover {
  opacity: 1;
  mix-blend-mode: lighten;
}

.movie-card__icon:not(:first-of-type) {
  margin-left: 5px;
}

.movie-card__icon i {
  font-size: 1.2em;
}

.movie-card__content {
  width: 100%;
  max-width: 370px;
  display: flex;
  align-items: flex-start;
  flex-direction: column;
  position: relative;
  float: right;
  padding-right: 1.2em;
  padding-bottom: 1em;
}

@media screen and (max-width: 1000px) {
  .movie-card__content {
    width: 50%;
  }
}

@media screen and (max-width: 600px) {
  .movie-card__content {
    margin-top: 4.2em;
    width: 100%;
    float: inherit;
    max-width: 100%;
    padding: 0 1em 1em;
  }
}

.movie-card__header {
  margin-bottom: 2em;
}

.movie-card__title {
  color: #ffffff;
  margin-bottom: 0.25em;
  opacity: 0.75;
}

.movie-card__info {
  text-transform: uppercase;
  letter-spacing: 2px;
  font-size: 0.8em;
  color: #2a9fff;
  line-height: 1;
  margin: 0;
  font-weight: 700;
  opacity: 1;
  text-shadow: 0px 0px 5px #fff;
}

.movie-card__desc {
  color: #fff;
  font-weight: 300;
  opacity: 0.84;
  margin-bottom: 2em;
}

.cine h1,
.cine h2,
.cine h3 {
  font-family: "Montserrat", helvetica, arial, sans-serif;
  text-transform: uppercase;
  letter-spacing: 2px;
  line-height: 1;
  font-weight: 400;
}

.cine .btn {
  padding: 0.5rem 2rem;
  background-color: rgba(255, 255, 255, 0.4);
  color: white;
}

.cine .btn-outline {
  background-color: transparent;
  border: 3px solid #ffffff;
}

.cine .btn-outline:hover {
  border-color: #2a9fff;
  color: #2a9fff;
  box-shadow: 0px 1px 8px 0px rgba(245, 199, 0, 0.2);
}

.card-sl {
  border-radius: 8px;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  margin-top: 75px;
}

.card-sl .card-image img {
  max-height: 100%;
  max-width: 100%;
  border-radius: 8px 8px 0px 0;
}

.card-sl .card-action {
  position: relative;
  float: right;
  margin-top: -25px;
  margin-right: 20px;
  z-index: 2;
  color: #E26D5C;
  background: #fff;
  border-radius: 100%;
  padding: 15px;
  font-size: 15px;
  box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 2px 0 rgba(0, 0, 0, 0.19);
}

.card-sl .card-action:hover {
  color: #fff;
  background: #E26D5C;
  -webkit-animation: pulse 1.5s infinite;
}

.card-sl .card-heading {
  font-size: 18px;
  font-weight: bold;
  background: #fff;
  padding: 10px 15px;
}

.card-sl .card-text {
  padding: 10px 15px;
  background: #fff;
  font-size: 14px;
  color: #636262;
}

.card-sl .card-button {
  display: flex;
  justify-content: center;
  padding: 10px 0;
  width: 100%;
  background-color: #1F487E;
  color: #fff;
  border-radius: 0 0 8px 8px;
}

.card-sl .card-button:hover {
  text-decoration: none;
  background-color: #1D3461;
  color: #fff;

}


@-webkit-keyframes pulse {
  0% {
    -moz-transform: scale(0.9);
    -ms-transform: scale(0.9);
    -webkit-transform: scale(0.9);
    transform: scale(0.9);
  }

  70% {
    -moz-transform: scale(1);
    -ms-transform: scale(1);
    -webkit-transform: scale(1);
    transform: scale(1);
    box-shadow: 0 0 0 50px rgba(90, 153, 212, 0);
  }

  100% {
    -moz-transform: scale(0.9);
    -ms-transform: scale(0.9);
    -webkit-transform: scale(0.9);
    transform: scale(0.9);
    box-shadow: 0 0 0 0 rgba(90, 153, 212, 0);
  }
}
</style>
