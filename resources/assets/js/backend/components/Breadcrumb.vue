<template>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a :href="this.$app.homePath">{{ $t('labels.frontend.titles.home') }}</a>
        </li>
        <li class="breadcrumb-item" v-for="(item, index) in list">
            <span class="active" v-if="isLast(index)">{{ showName(item) }}</span>
            <router-link :to="item.path === '' ? '/' : item.path" v-else>{{ showName(item) }}</router-link>
        </li>
    </ol>
</template>

<script>
  export default {
    props: {
      list: {
        type: Array,
        required: true,
        default: () => []
      }
    },
    methods: {
      isLast (index) {
        return index === this.list.length - 1
      },
      showName (item) {
        if (item.meta && item.meta.title) {
          item = item.meta && item.meta.title
        }
        if (item.name) {
          item = item.name
        }
        return item
      }
    }
  }
</script>
