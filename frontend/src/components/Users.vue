<template>
  <div>
    <!-- Form to Create User -->
    <form @submit.prevent="submitUser">
      <input v-model="user.first_name" placeholder="Prénom" required />
      <input v-model="user.last_name" placeholder="Nom" required />
      <input v-model="user.birthdate" type="date" required />
      <button type="submit">Créer</button>
    </form>

    <!-- User List with Filter -->
    <div>
      <input 
        v-model="jobFilter" 
        placeholder="Filtrer par emploi"
        @input="filterUsers" 
      />

      <table>
        <thead>
          <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Âge</th>
            <th>Emploi Actuel</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="user in filteredUsers" :key="user.id">
            <td>{{ user.last_name }}</td>
            <td>{{ user.first_name }}</td>
            <td>{{ user.age }}</td>
            <td>
              <ul>
                <li v-for="job in user.current_jobs" :key="job">{{ job }}</li>
              </ul>
            </td>
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
      user: {
        first_name: '',
        last_name: '',
        birthdate: '',
      },
      users: [],
      jobFilter: '',
      filteredUsers: []
    };
  },
  mounted() {
    this.fetchUsers();
  },
  methods: {

    async submitUser() {
      try {
        const formattedUser = {
          first_name: this.user.first_name,
          last_name: this.user.last_name,
          birth_date: this.user.birthdate,
        };
        await axios.post('http://127.0.0.1:8000/api/users', formattedUser);
        this.resetForm();
        this.fetchUsers();
      } catch (error) {
        console.error("Erreur lors de la soumission :", error.response?.data || error);
      }
    },
    resetForm() {
      this.user = {
        first_name: '',
        last_name: '',
        birthdate: '',
      };
    },

    async fetchUsers() {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/users');
        this.users = response.data.data;
        this.filteredUsers = this.users.sort((a, b) => 
          a.last_name.localeCompare(b.last_name)
        );
      } catch (error) {
        console.error("Erreur lors de la récupération des utilisateurs :", error);
      }
    },

  
    filterUsers() {
          if (this.jobFilter) {
            this.filteredUsers = this.users.filter(user =>
              user.current_jobs.some(job => job.toLowerCase().includes(this.jobFilter.toLowerCase()))
            );
          } else {
            this.filteredUsers = this.users;
          }
        }
  }
};
</script>
