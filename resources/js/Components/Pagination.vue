<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({
  links: {
    type: Array,
    default: () => []
  }
})

</script>

<template>
    <div class="flex gap-2 mt-6">
        <template v-for="link in links" :key="link.label">
          <span
              v-if="!link.url"
              class="px-3 py-1 border rounded text-gray-400"
              v-html="link.label"
          />

            <Link
                v-else
                :href="link.url"
                class="px-3 py-1 border rounded"
                :class="{
                  'bg-gray-900 text-white': link.active,
                }"
                v-html="link.label"
            />
        </template>
    </div>
</template>
