<template>
  <div>
    <h1>Liste des Besoins</h1>
    <ul>
      <li v-for="besoin in besoins" :key="besoin.id">
        {{ besoin.libelle }} - {{ besoin.description }}
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  data() {
    return {
      besoins: []
    };
  },
  created() {
    this.fetchBesoins();
  },
  methods: {
    async fetchBesoins() {
      try {
        const response = await fetch('http://localhost:40016/besoins');
        this.besoins = await response.json();
      } catch (error) {
        console.error('Erreur lors de la récupération des besoins:', error);
      }
    }
  }
};
</script>

<style scoped>
/* Ajoutez ici vos styles pour le composant */
</style>