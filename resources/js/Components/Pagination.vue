<template>
    <div class="flex flex-col md:flex-row items-center justify-between">
      <p class="text-sm">
        Página Atual: {{ pagination.current_page }} de Total: {{ pagination.last_page }}
      </p>
      <nav class="mt-4 md:mt-0">
        <ul class="inline-flex items-center space-x-2">
          <li>
            <button
              @click="goToPage(1)"
              :disabled="pagination.current_page === 1"
              class="px-3 py-1 rounded border border-gray-300 bg-white text-gray-500 hover:bg-gray-200 disabled:opacity-50"
            >
              ««
            </button>
          </li>
          <li>
            <button
              @click="goToPage(pagination.current_page - 1)"
              :disabled="!pagination.prev_page_url"
              class="px-3 py-1 rounded border border-gray-300 bg-white text-gray-500 hover:bg-gray-200 disabled:opacity-50"
            >
              «
            </button>
          </li>
          <li v-for="link in pageLinks" :key="link.label">
            <button
              v-if="link.url"
              @click="goToPage(link.label)"
              :class="[
                'px-3 py-1 rounded border border-gray-300',
                link.active
                  ? 'bg-blue-500 text-white'
                  : 'bg-white text-gray-500 hover:bg-gray-200'
              ]"
            >
              {{ link.label }}
            </button>
          </li>
          <li>
            <button
              @click="goToPage(pagination.current_page + 1)"
              :disabled="!pagination.next_page_url"
              class="px-3 py-1 rounded border border-gray-300 bg-white text-gray-500 hover:bg-gray-200 disabled:opacity-50"
            >
              »
            </button>
          </li>
          <li>
            <button
              @click="goToPage(pagination.last_page)"
              :disabled="pagination.current_page === pagination.last_page"
              class="px-3 py-1 rounded border border-gray-300 bg-white text-gray-500 hover:bg-gray-200 disabled:opacity-50"
            >
              »»
            </button>
          </li>
        </ul>
      </nav>
    </div>
  </template>

  <script>
  export default {
    props: {
      paginationData: {
        type: Object,
        required: true
      }
    },
    data() {
      return {
        pagination: this.paginationData
      };
    },
    computed: {
      pageLinks() {
        const links = this.pagination.links.filter(link => !['&laquo; Previous', 'Next &raquo;'].includes(link.label));
        return links.map(link => {
          return {
            ...link,
            label: link.label.replace('&laquo;', '').replace('&raquo;', '').trim()
          };
        });
      }
    },
    methods: {
      goToPage(page) {
        if (page < 1 || page > this.pagination.last_page) return;
        this.$emit('page-change', page);
      }
    }
  };
  </script>

  <style scoped>
  /* Add any additional custom styles here */
  </style>
