<template>
  <div>
    <div>
      <h2>Ajouter un Emploi</h2>
      <form @submit.prevent="addJob">
        <select v-model="selectedUserId" required>
          <option value="">Sélectionner un utilisateur</option>
          <option v-for="user in users" :value="user.id" :key="user.id">
            {{ user.first_name }} {{ user.last_name }}
          </option>
        </select>
        <input v-model="jobTitle" placeholder="Titre de l'emploi" required />
        <input v-model="startDate" type="date" placeholder="Date de début" required />
        <input v-model="endDate" type="date" placeholder="Date de fin (optionnelle)" />
        <button type="submit">Ajouter</button>
      </form>
    </div>

    <div>
      <h2>Liste des Emplois</h2>
      <table>
        <thead>
          <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Emploi</th>
            <th>Dates</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="job in jobs" :key="job.id">
            <td>{{ job.user.first_name }}</td>
            <td>{{ job.user.last_name }}</td>
            <td>{{ job.company_name }}</td>
            <td>{{ job.start_date }} - {{ job.end_date || "Présent" }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      selectedUserId: '',
      jobTitle: '',
      startDate: '',
      endDate: '',
      users: [],
      jobs: []
    };
  },
  mounted() {
    this.getUsers();
    this.fetchJobs();
  },
  methods: {
    
    async getUsers() {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/users');
        this.users = response.data.data;
      } catch (error) {
        console.error("Erreur lors de la récupération des utilisateurs", error);
      }
    },

   async addJob() {

      if (!this.selectedUserId) {
        alert("Veuillez sélectionner un utilisateur.");
        return;
      }

      const jobData = {
        user_id: this.selectedUserId,
        company_name: this.jobTitle,
        start_date: this.startDate,
        end_date: this.endDate || null,
      };

        console.log(jobData)


      try {
        const response = await axios.post(`http://127.0.0.1:8000/api/users/${this.selectedUserId}/jobs`, jobData);
        console.log('Réponse', response);
        this.resetJobForm();
        this.fetchJobs();
      } catch (error) {
        console.error('Erreur lors de l\'ajout de l\'emploi', error);
      }
    },


    resetJobForm() {
      this.selectedUserId = '';
      this.jobTitle = '';
      this.startDate = '';
      this.endDate = '';
    },

   
    async fetchJobs() {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/jobs');
        this.jobs = response.data.data;
      } catch (error) {
        console.error("Erreur lors de la récupération des emplois", error);
      }
    },
  },
};
</script>

