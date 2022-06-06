<template>
  <div class="currentCinemas">
    <div class="cinemas-list">
      <div class="currentCinemas-searchBar mb-5 mt-5 m-auto">
        <form class="search-box">
          <input type="text" placeholder="Buscar pelicula..." v-model="search" />
          <button type="reset" @click="search = '';"></button>
        </form>
      </div>
      <div class="cinemas-wrapper">
        <div class="msgFilter" v-if="filterMovie.length == 0">No hay ningún cinema que coincida!</div>

        <div class="card" v-for="(cine, i) in filterMovie" :key="i">
          <div class="card-header">
            <img :src="'/storage/' + cine.img" v-bind:alt="cine.empresa + cine.localidad" />
          </div>
          <div class="card-body">
            <span :class="'tag tag-'+tag[rand()]">{{ cine.empresa }} <i>{{ cine.localidad }}</i></span>
            <h4>
              {{ cine.direccion }}
            </h4>
            <p>
              {{ cine.telf }}
            </p>
            <div class="user">
              <button class="buttons fill" @click="visitCinema(cine)">Más...</button>
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
      search: "",
      cinemas: [],
      cineObj: {},
      tag: ['teal', 'purple', 'pink'],
    };
  },

  async mounted() {
    await this.getCinemas();
  },

  computed: {
    filterMovie: function () {
      return this.cinemas.filter((cine) => {
        return (
          cine.empresa.toLowerCase().match(this.search.toLowerCase()) ||
          cine.localidad.toLowerCase().match(this.search.toLowerCase())
        );
      });
    },
  },

  methods: {
    async getCinemas() {
      try {
        let response = await axios
          .get("http://ask4urticket.herokuapp.com/cinemasJSON")
          .then((response) => response.data)
          .catch(function () {
          });

        for (let i = 0; i < response.length; i++) {
          this.cineObj = {
            id: response[i].id,
            empresa: response[i].nombre,
            localidad: response[i].localidad,
            direccion: response[i].direccion,
            telf: response[i].telefono,
            img: response[i].img,
          };

          this.cinemas.push(this.cineObj);
        }
      } catch (e) {
        alert("ERROR [¿No internet?] en getCinemas() de currentCinemas.vue: " + e);
      }
    },

    rand() {
      let rand = Math.round(Math.random() * ((this.tag.length-1) - (this.tag.length - this.tag.length)) + (this.tag.length - this.tag.length));
      return rand;
    },

    async visitCinema(cinemaObject) {
      window.location.href = `/cinemas/${cinemaObject.id}`;
    }
  },
};
</script>

<style>
@import url("https://fonts.googleapis.com/css2?family=Roboto&display=swap");
.cinemas-list {
  display: flex;
  flex-direction: column;
  width: 75%;
  margin: auto;

}

.cinemas-wrapper {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 40px;
}

.cinema-item {
  transition: .2s all ease-in-out;
}

.cinema-item:hover {
  box-shadow: 1px 1px 5px #000;
  transform: scale(1.01);
}

.cinema-item .address {
  height: 50px;
}

.cinema-item img {
  height: 100%;
}

.telfButton-wrapper {
  display: flex;
  justify-content: space-between;
}

.currentCinemas-searchBar {
  position: relative;
}

.currentCinemas-searchBar .box {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}

.currentCinemas-searchBar .input {
  padding: 10px;
  width: 80px;
  height: 80px;
  background: none;
  border: 4px solid #0c63b4;
  border-radius: 50px;
  box-sizing: border-box;
  font-size: 26px;
  color: #fff;
  font-weight: bold;
  outline: none;
  transition: .5s;
}

.currentCinemas-searchBar .box input:focus,
.box:hover input {
  width: 350px;
  background: #272133;
  border-radius: 10px;
}

.currentCinemas-searchBar i {
  position: absolute;
  top: 45%;
  right: 15px;
  transform: translate(-50%, -50%);
  font-size: 26px;
  color: #0c63b4;
  transition: .2s;
}

.currentCinemas-searchBar .box:hover i {
  opacity: 0;
  z-index: -1;
}

.currentCinemas-searchBar .search-box {
  border: solid 5px black;
  display: inline-block;
  position: relative;
  border-radius: 50px;
}

.currentCinemas-searchBar .search-box input[type=text] {
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

.currentCinemas-searchBar .search-box input[type=text]:focus {
  outline: none;
}

.currentCinemas-searchBar .search-box input[type=text]:focus,
.currentCinemas-searchBar .search-box input[type=text]:not(:placeholder-shown) {
  width: 300px;
  transition: width 800ms cubic-bezier(0.68, -0.55, 0.27, 1.55);
}

.currentCinemas-searchBar .search-box input[type=text]:focus+button[type=reset],
.currentCinemas-searchBar .search-box input[type=text]:not(:placeholder-shown)+button[type=reset] {
  bottom: 13px;
  right: 10px;
  transition: bottom 150ms ease-out 800ms, right 150ms ease-out 800ms;
}

.currentCinemas-searchBar .search-box input[type=text]:focus+button[type=reset]:after,
.currentCinemas-searchBar .search-box input[type=text]:not(:placeholder-shown)+button[type=reset]:after {
  top: 0;
  right: 10px;
  opacity: 1;
  transition: top 150ms ease-out 950ms, right 150ms ease-out 950ms, opacity 150ms ease 950ms;
}

.currentCinemas-searchBar .search-box button[type=reset] {
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

.currentCinemas-searchBar .search-box button[type=reset]:before,
.currentCinemas-searchBar .search-box button[type=reset]:after {
  content: "";
  height: 25px;
  border-left: solid 5px black;
  position: absolute;
  transform: rotate(-45deg);
}

.currentCinemas-searchBar .search-box button[type=reset]:after {
  transform: rotate(45deg);
  opacity: 0;
  top: -20px;
  right: -10px;
  transition: top 150ms ease-out, right 150ms ease-out, opacity 150ms ease-out;
}

.cinemas-wrapper .card {
  margin: 10px;
  background-color: #fff;
  border-radius: 10px;
  box-shadow: 0 2px 20px rgba(0, 0, 0, 0.2);
  overflow: hidden;
  width: 300px;
}

.cinemas-wrapper .card-header {
  padding: 0;
}

.cinemas-wrapper .card-header img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.cinemas-wrapper .card-body {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: flex-start;
  padding: 20px;
  min-height: 250px;
}

.cinemas-wrapper .tag {
  background: #cccccc;
  border-radius: 50px;
  font-size: 12px;
  margin: 0;
  color: #fff;
  padding: 2px 10px;
  text-transform: uppercase;
  cursor: pointer;
}

.cinemas-wrapper .tag-teal {
  background-color: #47bcd4;
}

.cinemas-wrapper .tag-purple {
  background-color: #5e76bf;
}

.cinemas-wrapper .tag-pink {
  background-color: #cd5b9f;
}

.cinemas-wrapper .card-body p {
  font-size: 13px;
  margin: 0 0 40px;
}

.user {
  display: flex;
  margin-top: auto;
}

.user img {
  border-radius: 50%;
  width: 40px;
  height: 40px;
  margin-right: 10px;
}

.user-info h5 {
  margin: 0;
}

.user-info small {
  color: #545d7a;
}


@media (max-width: 1024px) {
  .cinemas-wrapper {
    grid-template-columns: repeat(2, 1fr);
  }
}

@media (max-width: 768px) {
  .cinemas-wrapper {
    grid-template-columns: repeat(1, 1fr);
  }

  .cinema-item-card {
    width: 500px;
  }
}

.fill {
  --color: #a972cb;
  --hover: #cb72aa;
}

.fill:hover,
.fill:focus {
  box-shadow: inset 0 0 0 2em var(--hover);
}

.user button {
  color: var(--color);
  transition: 0.25s;
}
.user button:hover, button:focus {
  border-color: var(--hover);
  color: #fff;
}

.user button {
  background: none;
  border: 2px solid;
  font: inherit;
  line-height: 1;
  margin: 0.5em;
  padding: 1em 2em;
}
</style>
