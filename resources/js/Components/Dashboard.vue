<script setup>
import { defineProps, ref, onMounted } from "vue";
import Chart from "chart.js/auto";

// Recebe os dados de visitas do backend
const props = defineProps({
  visits: {
    type: Array,
  },
});

const chart = ref(null);
onMounted(() => {
  const ctx = chart.value.getContext("2d");

  // Configura o gráfico de barras usando os dados dinâmicos de visitas
  chart.value = new Chart(ctx, {
    type: "bar",
    data: {
      labels: [
        "Jan", "Feb", "Mar", "Apr", "May", "Jun",
        "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
      ],
      datasets: [
        {
          label: "Visits",
          data: props.visits,
          backgroundColor: "#3182CE",
          borderColor: "#3182CE",
          borderWidth: 1,
        },
      ],
    },
    options: {
      scales: {
        y: {
          beginAtZero: true,
        },
      },
    },
  });
});
</script>

<template>
  <div>
    <div
      class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700"
    >
      <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">
        Visits
      </h2>
      <p class="text-sm text-gray-500 dark:text-gray-300">
        Visits in the last 30 days
      </p>

      <div class="mt-4">
        <canvas ref="chart" width="400" height="200"></canvas>
      </div>
    </div>
  </div>
</template>
