import { createRouter, createWebHistory } from "vue-router";
import Users from "../components/Users.vue";
import Job from "../components/Jobs.vue";

const routes = [
  {
    path: "/",
    name: "Users",
    component: Users,
  },
  {
    path: "/jobs",
    name: "Jobs",
    component: Job,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
