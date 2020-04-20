<template>
  <SchemaForm
    v-bind="bind"
  >
    <template
      v-if="studentView"
      v-slot:form-body="{ record }"
    >
      <div class="ActivityForm">
        <h5>
          {{ $util.get(record, 'grade.name') }}
        </h5>
        <h6>
          {{ $util.get(record, 'name') }}
        </h6>
        <p
          v-html="$util.get(record, 'description')"
          class="q-mt-lg q-mb-lg"
        />
        <ActivityContentViewer
          :type="$util.get(record, 'type')"
          :documentType="$util.get(record, 'documentType')"
          :document="$util.get(record, 'document')"
          :linkType="$util.get(record, 'linkType')"
          :link="$util.get(record, 'link')"
        />
      </div>
    </template>
  </SchemaForm>
</template>

<script type="text/javascript">
import View from 'src/app/Agnostic/Adapters/View'
import Schema from 'src/domains/Academic/Activity/Schema/ActivitySchema'
import { REFERENCE } from 'src/settings/profile'
import { SCOPES } from 'src/app/Agnostic/enum'
import ActivityContentViewer from 'src/views/dashboard/academic/activity/components/ActivityContentViewer'

/**
 */
export default {
  components: { ActivityContentViewer },
  /**
   */
  extends: View,
  /**
   */
  name: 'ActivityForm',
  /**
   */
  schema: Schema,
  /**
   */
  computed: {
    /**
     * @return {boolean}
     */
    studentView () {
      const scope = this.$route.meta.scope
      const reference = this.$store.getters['auth/getUserProfileReference']
      return scope === SCOPES.SCOPE_VIEW && reference === REFERENCE.REFERENCE_STUDENT
    }
  }
}
</script>

<style
  lang="stylus"
  rel="stylesheet/stylus"
>
.ActivityForm
  border-width 0 0 1px 0
  border-style solid
  border-color #ddd
  padding 15px 30px
  height calc(100vh - 165px)
  overflow auto

  h5, h6
    margin 10px 0
</style>
