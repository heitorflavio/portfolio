<script setup>
import { Head, Link } from "@inertiajs/vue3";
import { defineProps, onMounted } from "vue";

defineProps({
  projects: {
    type: Array,
    required: true,
  },
  skills: {
    type: Array,
    required: true,
  },
  canLogin: {
    type: Boolean,
  },
  canRegister: {
    type: Boolean,
  },
  laravelVersion: {
    type: String,
    required: true,
  },
  phpVersion: {
    type: String,
    required: true,
  },
});

onMounted(() => {
  document.addEventListener("DOMContentLoaded", function () {
    const fadeIns = document.querySelectorAll(".fade-in");
    window.addEventListener("scroll", () => {
      fadeIns.forEach((el) => {
        const rect = el.getBoundingClientRect();
        if (rect.top < window.innerHeight) {
          el.classList.add("show");
        }
      });
    });
  });
}),
  function handleImageError() {
    document.getElementById("screenshot-container")?.classList.add("!hidden");
    document.getElementById("docs-card")?.classList.add("!row-span-1");
    document.getElementById("docs-card-content")?.classList.add("!flex-row");
    document.getElementById("background")?.classList.add("!hidden");
  };
</script>


<template>
  <Head title="Welcome" />
  <div class="bg-gray-900 text-gray-300 font-sans">
    <!-- Hero Section -->
    <section
      class="min-h-screen flex flex-col justify-center items-center bg-gray-900"
      style="
        background-image: url('/assets/img/background.gif');
        background-size: cover; background-position: center;
      "
    >
      <div class="text-center fade-in show">
        <h1 class="text-5xl font-bold text-white mb-4">Heitor Flavio</h1>
        <p class="text-xl text-gray-400 mb-8">
          Desenvolvedor Web Full Stack | Laravel, Vue.js, Django
        </p>
        <a
          href="#projetos"
          class="bg-blue-600 text-white py-3 px-8 rounded-full hover:bg-blue-500 transition duration-300"
        >
          Veja Meus Projetos
        </a>
      </div>
    </section>

    <!-- Sobre Mim Section -->
    <section id="sobre" class="py-16 bg-gray-800">
      <div class="container mx-auto text-center">
        <h2 class="text-4xl font-semibold text-white mb-6 fade-in">
          Sobre Mim
        </h2>
        <p class="text-lg text-gray-400 leading-7 fade-in max-w-3xl mx-auto">
          Sou um desenvolvedor apaixonado por criar soluções modernas e
          funcionais. Com experiência em Laravel, Vue.js, e Django, trabalho na
          construção de aplicações web que otimizam processos e proporcionam
          experiências incríveis aos usuários.
        </p>
      </div>
    </section>

    <!-- Habilidades Section -->
    <section id="habilidades" class="py-16 bg-gray-900">
      <div class="container mx-auto text-center">
        <h2 class="text-4xl font-semibold text-white mb-6 fade-in">
          Habilidades
        </h2>
        <div
          class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 fade-in"
        >
          <div
            class="bg-gray-800 p-8 rounded-lg hover:shadow-lg transition duration-300"
            v-for="(skill, index) in skills" :key="index"
          >
            <h3 class="text-xl font-bold text-white">{{ skill.title }}</h3>
            <p class="text-gray-400 mt-2">
              {{ skill.description }}
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Projetos Section -->
    <section id="projetos" class="py-16 bg-gray-800">
      <div class="container mx-auto text-center">
        <h2 class="text-4xl font-semibold text-white mb-6 fade-in">
          Projetos Recentes
        </h2>
        <div
          class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12 fade-in"
        >
          <div
            class="bg-gray-900 p-6 rounded-lg shadow-lg hover:shadow-2xl transition duration-300"
            v-for="(project, index) in projects"
            :key="index"
          >
            <img
              :src="`${project.image}`"
              alt="Projeto 1"
              class="w-full h-64 object-cover rounded-t-lg mb-4"
            />
            <h3 class="text-2xl font-semibold text-white">
              {{ project.title }}
            </h3>
            <p class="text-gray-400 mt-2">
              {{ project.description }}
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Contato Section -->
    <section id="contato" class="py-16 bg-gray-900">
      <div class="container mx-auto text-center">
        <h2 class="text-4xl font-semibold text-white mb-6 fade-in">
          Entre em Contato
        </h2>
        <p class="text-gray-400 leading-7 max-w-2xl mx-auto mb-8 fade-in">
          Estou sempre aberto a novos desafios e oportunidades. Vamos conversar
          sobre como posso ajudar no seu projeto!
        </p>
        <a
          href="mailto:heitor@example.com"
          class="bg-blue-600 text-white py-3 px-8 rounded-full hover:bg-blue-500 transition duration-300"
        >
          Fale Comigo
        </a>
      </div>
    </section>

    <!-- Footer -->
    <footer class="py-6 bg-gray-800 text-center">
      <p class="text-gray-400">
        &copy; 2024 Heitor - Todos os direitos reservados.
      </p>
    </footer>
  </div>
</template>

<style scoped>
</style>