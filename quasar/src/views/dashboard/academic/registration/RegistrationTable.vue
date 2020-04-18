<template>
  <SchemaTable v-bind="bind" />
</template>

<script type="text/javascript">
import View from 'src/app/Agnostic/Adapters/View'
import Schema from 'src/domains/Academic/Registration/Schema/RegistrationSchema'

/**
 */
export default {
  /**
   */
  extends: View,
  /**
   */
  name: 'RegistrationTable',
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
