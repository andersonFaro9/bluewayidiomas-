<template>
  <SchemaForm v-bind="bind" />
</template>

<script type="text/javascript">
import View from 'src/app/Agnostic/Adapters/View'
import Schema from 'src/domains/Academic/Activity/Schema/ActivitySchema'

/**
 */
export default {
  /**
   */
  extends: View,
  /**
   */
  name: 'ActivityForm',
  /**
   */
  schema: Schema
}
</script>

<style
  lang="stylus"
  rel="stylesheet/stylus"
>
</style>
