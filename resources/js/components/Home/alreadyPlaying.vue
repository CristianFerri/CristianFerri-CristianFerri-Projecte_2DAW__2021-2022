<template>
  <div class="alreadyPlaying-wrapper">
    <loader object="#ff9633" color1="#ffffff" color2="#17fd3d" size="5" speed="2" bg="#343a40" disableScrolling="true"
      objectbg="#999793" opacity="80" name="circular" v-if="!getMoviesDone || !getGenresDone"></loader>
    <div class="row" v-if="getMoviesDone">
      <div class="col-md-4 border-end mt-5">
        <div class="mb-3 msgFiltro" >Pulsa en la lupa para buscar</div>
        <div class="alreadyPlaying-searchBar mb-5">
          <form class="search-box">
            <input type="text" placeholder="Buscar pelicula..." v-model="search" />
            <button type="reset" @click="search = '';"></button>
          </form>
        </div>
        <div class="filterGenres" v-if="getGenresDone">
          <select class="form-select generosSelect" v-model="genreFilter" size="1">
            <option :value="''" selected>Seleccione una opción...</option>
            <option v-for="(g, i) in genres" :key="i" :value="g.id">{{ g.name }}</option>
          </select>
        </div>
      </div>
      <div class="col-md-8 pt-4">
        <div class="alreadyPlaying-list text-center m-auto">
          <div v-if="filterMoviesSearch.length == 0">No se ha encontrado ninguna pelicula con ese nombre!</div>
          <div class="alreadyPlaying-list-item" v-for="(movie, i) in filterMoviesSearch" :key="i">
            <img class="alreadyPlaying-list-item-img" :src="movie.img" :alt="movie.title" @click="getCinema(movie)" />
            <div class="alreadyPlaying-list-item-votes text-warning fs-2">
              <font-awesome-icon icon="fa-solid fa-star" />
              <b>{{ movie.votes }}</b>
            </div>
            <div class="containerButtons">
              <span class="buttonGenres" @click="movie.dropdown = !movie.dropdown">
                <button class="btn btn-outline-info">
                  GENEROS
                  <font-awesome-icon icon="fa-solid fa-plus" class="cross" />
                </button>
              </span>
              <span class="buttonWatchnow">
                <button class="btn btn-success" @click="getCinema(movie)">
                  VER AHORA
                </button>
              </span>
            </div>
            <div class="alreadyPlaying-list-item-wrapper"
              :class="{ slideToUp: !movie.dropdown, slideToDown: movie.dropdown }">
              <div v-for="(genre, x) in movie.genres" :key="x">
                <p class="genre">{{ genre.name }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="selectCinema" v-if="getCinemasDone && mostrarSelector">
      <div class="dark"></div>
      <div class="Selector">
        <p v-if="alreadyAdded">No hay ningún cine que emita esta pelicula todavía, lo sentimos, vuelve más tarde</p>
        <div id="opciones">
          <div class="cinesSeleccionar-padre" v-for="(cine, i) in cinemas" :key="i">
            <option class="cinesSeleccionar" type="radio" @click="getSelected(cine.cine_id)"> {{ cine.nombre }} {{
                cine.localidad
            }} </option>
          </div>
        </div>
        <button @click="cerrarBTN()" class="cerrar btn btn-danger mt-5">CERRAR</button>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      movies: [],
      cinemas: [],
      cineSelected: '',
      movieSelected: '',
      getCinemasDone: false,
      getMoviesDone: false,
      search: '',
      alreadyAdded: false,
      api_id_temp: '',
      mostrarSelector: false,
      genres: [],
      getGenresDone: false,
      genreFilter: '',
      showMsgFilter: true,
    } //return
  }, //data

  async mounted() {
    await this.getAlreadyPlayingFromApi();
    await this.getGenres();
  },//mounted

  computed: {
    filterMoviesSearch() {
      if (this.search == '' && this.genreFilter == '') {
        return this.movies;
      } else if (this.search != '' && this.genreFilter != '') {
        return this.movies.filter(movie => {
          return movie.title.toLowerCase().includes(this.search.toLowerCase()) && movie.genres.some(genre => genre.id == this.genreFilter);
        });
      } else if (this.search != '') {
        return this.movies.filter(movie => {
          return movie.title.toLowerCase().includes(this.search.toLowerCase());
        });
      } else if (this.genreFilter != '') {
        return this.movies.filter(movie => {
          return movie.genres.some(genre => genre.id == this.genreFilter);
        });
      }
    },
  },//computed

  methods: {
    async getAlreadyPlayingFromApi() {
      try {
        let response = await axios.get('http://ask4urticket.herokuapp.com/peliculas/get')
          .then(response => response.data)
          .catch(response => response.data, () => {
          });

        for (let i = 0; i < response.length; i++) {
          this.api_id_temp = response[i].api_id;
          let movie = {
            id: response[i].id,
            api_id: response[i].api_id,
            title: response[i].title,
            img: response[i].poster,
            genres: await this.getGenresID(this.api_id_temp),
            votes: response[i].votes,
            dropdown: false,
          }
          this.movies.push(movie);
        }

        this.getMoviesDone = true;
      } catch (e) {
      }
    },

    async getGenresID(api_id) {
      try {
        let response = await axios.get(`https://api.themoviedb.org/3/movie/${api_id}?api_key=4475c14c3e095c6c8e3ca8d00f5070d5&language=es`)
          .then(response => response.data)
          .catch(response => response.data, () => {
          });

        return response.genres;

      } catch (e) {
      }
    },

    async getGenres() {
      try {
        let response = await axios.get('https://api.themoviedb.org/3/genre/movie/list?api_key=4475c14c3e095c6c8e3ca8d00f5070d5&language=es')
          .then(response => response.data)
          .catch(response => response.data, () => {
          });

        for (let i = 0; i < response.genres.length; i++) {
          this.genres.push({ id: response.genres[i].id, name: response.genres[i].name });
        }

        this.getGenresDone = true;

      } catch (e) {
      }
    },

    async redirect() {
      if (this.cineSelected !== null || this.movieSelected !== null) {
        window.location.href = `/cinemas/${this.cineSelected}/movie/${this.movieSelected}`;
      } else {
        this.showError = true;
      }
    },

    async getCinema(peliculaId) {
      this.movieSelected = peliculaId.api_id;
      let response = await axios.get(`http://ask4urticket.herokuapp.com/pelicula/x/cine/${peliculaId.id}`)
        .then(response => response.data)
        .catch(function () {
        })

      if (response.success === false) {
        this.alreadyAdded = true;
      } else if (response.success === undefined) {
        this.alreadyAdded = false;
      }

      for (let i = 0; i < response.length; i++) {
        this.cinemas.push(
          {
            cine_id: response[i].cine_id,
            nombre: response[i].nombre,
            localidad: response[i].localidad
          }
        )
      }
      this.getCinemasDone = true;
      this.mostrarSelector = true;
      document.getElementsByTagName('body')[0].style.overflow = 'hidden';
    },

    getSelected(idCine) {
      this.showError = true;
      this.cineSelected = idCine;
      this.redirect();
    },

    cerrarBTN() {
      let options = document.getElementById('opciones');
      while (options.firstChild) {
        options.removeChild(options.firstChild);
      }
      this.cinemas = [];
      this.mostrarSelector = false;
      document.getElementsByTagName('body')[0].style.overflow = 'auto';
    },
  } //methods
} //export default

</script>

<style>
@import url("https://fonts.googleapis.com/css2?family=Quicksand:wght@400;700&display=swap");
@import url("https://fonts.googleapis.com/css?family=Raleway:400,400i,700");

.alreadyPlaying-wrapper {
  font-family: "Quicksand", sans-serif;
  padding: 20px;
  text-align: center;
  display: flex;
  flex-direction: column;
  min-height: 75vw;
}

.alreadyPlaying-list {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 40px;
}

.alreadyPlaying-list-item {
  position: relative;
  margin: auto;
  margin-bottom: 50px;
}

.alreadyPlaying-list-item-img {
  margin-bottom: 20px;
  height: 350px;
  cursor: pointer;
  box-shadow: 1px 1px 10px #000;
  transition: all 0.3s ease-in-out;
  border-radius: 20px 5px 20px 5px;
}

.alreadyPlaying-list-item-img:hover {
  box-shadow: 1px 1px 20px #000;
}

.cross {
  color: red;
}

.alreadyPlaying-list-item-wrapper {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 10px;
  overflow: hidden;
  position: absolute;
  top: 101%;
}

.containerButtons {
  display: flex;
  justify-content: space-between;
  font-size: 1em;
  cursor: pointer;
}

.containerButtons button {
  font-weight: bold;
  border-radius: 5px 20px 5px 20px;
}

.genre {
  position: relative;
  font-size: 0.9em;
  margin: 0;
  font-weight: bold;
  text-decoration: underline;
  text-decoration-color: #0d6efd;
}

.alreadyPlaying-list-item .alreadyPlaying-list-item-votes {
  font-size: 1em;
  position: absolute;
  top: 0;
  right: 0;
  margin: 5px;
  transition: all 1s ease-in-out;
}

.alreadyPlaying-list-item .alreadyPlaying-list-item-votes>b {
  font-size: 0.7em;
  text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000,
    1px 1px 0 #000;
}

.slideToUp {
  height: 0px;
}

.slideToDown {
  height: 75px;
}

.alreadyPlaying-searchBar .search-box {
  border: solid 5px black;
  display: inline-block;
  position: relative;
  border-radius: 50px;
}

.alreadyPlaying-searchBar .search-box input[type=text] {
  font-family: Raleway, sans-serif;
  font-size: 20px;
  font-weight: bold;
  width: 50px;
  height: 50px;
  padding: 5px 40px 5px 10px;
  border: none;
  box-sizing: border-box;
  border-radius: 50px;
  transition: width 800ms cubic-bezier(0.68, -0.55, 0.27, 1.55) 150ms;
}

.alreadyPlaying-searchBar .search-box input[type=text]:focus {
  outline: none;
}

.alreadyPlaying-searchBar .search-box input[type=text]:focus,
.alreadyPlaying-searchBar .search-box input[type=text]:not(:placeholder-shown) {
  width: 300px;
  transition: width 800ms cubic-bezier(0.68, -0.55, 0.27, 1.55);
}

.alreadyPlaying-searchBar .search-box input[type=text]:focus+button[type=reset],
.alreadyPlaying-searchBar .search-box input[type=text]:not(:placeholder-shown)+button[type=reset] {
  bottom: 13px;
  right: 10px;
  transition: bottom 150ms ease-out 800ms, right 150ms ease-out 800ms;
}

.alreadyPlaying-searchBar .search-box input[type=text]:focus+button[type=reset]:after,
.alreadyPlaying-searchBar .search-box input[type=text]:not(:placeholder-shown)+button[type=reset]:after {
  top: 0;
  right: 10px;
  opacity: 1;
  transition: top 150ms ease-out 950ms, right 150ms ease-out 950ms, opacity 150ms ease 950ms;
}

.alreadyPlaying-searchBar .search-box button[type=reset] {
  background-color: transparent;
  width: 25px;
  height: 25px;
  border: 0;
  padding: 0;
  outline: 0;
  display: flex;
  justify-content: center;
  align-items: center;
  position: absolute;
  bottom: -13px;
  right: -15px;
  transition: bottom 150ms ease-out 150ms, right 150ms ease-out 150ms;
}

.alreadyPlaying-searchBar .search-box button[type=reset]:before,
.alreadyPlaying-searchBar .search-box button[type=reset]:after {
  content: "";
  height: 25px;
  border-left: solid 5px black;
  position: absolute;
  transform: rotate(-45deg);
}

.alreadyPlaying-searchBar .search-box button[type=reset]:after {
  transform: rotate(45deg);
  opacity: 0;
  top: -20px;
  right: -10px;
  transition: top 150ms ease-out, right 150ms ease-out, opacity 150ms ease-out;
}

.selectCinema {
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 450px;
  height: 500px;
  border-radius: 15px 40px;
  border: 1px solid black;
  z-index: 1000;
}

.dark {
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  height: 100vh;
  width: 100vw;
  background-color: rgba(0, 0, 0, 0.5);
  z-index: 10000;
}

.Selector {
  position: relative;
  padding: 15px;
  z-index: 9999999;
  background-color: #fff;
  height: 100%;
  border-radius: 15px 40px;
}

.Selector p {
  margin-top: 10px;
  font-size: 1.5em;
}

.cinesSeleccionar-padre {
  position: relative;
  width: 100%;
}

.cinesSeleccionar {
  background-color: lightgrey;
  font-size: 2.5em;
  font-weight: bold;
  transition: all .5s ease-in-out;
  outline: 1px solid #000;
  margin-top: 10px;
  border-radius: 40px 15px;
}

.cinesSeleccionar:hover {
  background-color: rgba(11, 190, 11, 0.583);
}

@media (max-width: 1024px) {
  .alreadyPlaying-list {
    grid-template-columns: repeat(2, 1fr);
  }

  .alreadyPlaying-searchBar .search-box {
    right: 25;
  }

  .alreadyPlaying-searchBar .search-box input[type="text"]:focus, 
  .alreadyPlaying-searchBar .search-box input[type="text"]:not(:placeholder-shown) {
    transition: width 800ms cubic-bezier(0.68, -0.55, 0.27, 1.20);
  }

  .alreadyPlaying-searchBar .search-box input[type="text"] {
    transition: width 800ms cubic-bezier(0.68, -0.40, 0.27, 1) 150ms;
  }

  .generosSelect {
    margin-left: -25px;
  }

  .msgFiltro {
    margin-left: -50px;
  }
}

@media (max-width: 768px) {
  .containerButtons button {
    font-size: 0.8em;
  }

  .buttonGenres {
    width: 40%;
  }

  .buttonWatchnow {
    width: 40%;
  }

  .alreadyPlaying-list-item-img {
    height: 300px;
    width: 100%;
  }

  .alreadyPlaying-list-item {
    width: 210px;
  }

  .msgFiltro {
    position: relative;
    left: -20;
  }
}

@media (max-width: 600px) {
  .msgFiltro {
    margin-left: 0;
    left: 0;
  }

  .generosSelect {
    margin-left: 0;
  }
}

@media (max-width: 480px) {
  .border-end {
    border-right: none !important;
    padding-bottom: 20px;
    border-bottom: 1px solid #dee2e6 !important;
  }

  .alreadyPlaying-searchBar .search-box {
    right: 0;
  }

  .alreadyPlaying-list {
    grid-template-columns: repeat(1, 1fr);
  }
}
</style>

