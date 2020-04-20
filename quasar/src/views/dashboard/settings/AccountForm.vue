<template>
  <SchemaForm v-bind="bind" />
</template>

<script type="text/javascript">
import View from 'src/app/Agnostic/Adapters/View'
import Schema from 'src/domains/Settings/Account/Schema/AccountSchema.js'

/**
 */
export default {
  /**
   */
  extends: View,
  /**
   */
  name: 'AccountForm',
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
