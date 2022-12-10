<template>
  <div>

    <Head title="Settings" />
    <h1 class="mb-8 text-3xl font-bold">Settings</h1>
    <div class="h-full border-2 bg-white border-grey-200 border-opacity-60 rounded-lg overflow-hidden">
      <div class="p-6">
        <LanguageSelector></LanguageSelector>
      </div>
    </div>
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3'
import Icon from '@/Shared/Icon'
import pickBy from 'lodash/pickBy'
import Layout from '@/Shared/Layout'
import throttle from 'lodash/throttle'
import mapValues from 'lodash/mapValues'
import Pagination from '@/Shared/Pagination'
import SearchFilter from '@/Shared/SearchFilter'
import LanguageSelector from '@/Shared/LanguageSelector'

export default {
  components: {
    Head,
    Icon,
    Link,
    Pagination,
    SearchFilter,
    LanguageSelector
},
  layout: Layout,
  props: {
    filters: Object,
    contacts: Object,
  },
  data() {
    return {
      form: {
        search: this.filters.search,
        trashed: this.filters.trashed,
      },
    }
  },
  watch: {
    form: {
      deep: true,
      handler: throttle(function () {
        this.$inertia.get('/contacts', pickBy(this.form), { preserveState: true })
      }, 150),
    },
  },
  methods: {
    reset() {
      this.form = mapValues(this.form, () => null)
    },
  },
}
</script>
