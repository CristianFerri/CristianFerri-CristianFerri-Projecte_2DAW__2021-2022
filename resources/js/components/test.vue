<template>
  <div>
  </div>
</template>

<script>

  export default {
    props: ['a'],

    async mounted() {
      this.$fire({
        title: "¡Ya esta!",
        text: "Se ha realizado el pedido con éxito, gracias por tu compra " + this.a.username,
        type: "success",
        timer: 6000
      }).then(r => {
        window.location.href = "http://ask4urticket.herokuapp.com/";
      });
    },
  }

</script>
