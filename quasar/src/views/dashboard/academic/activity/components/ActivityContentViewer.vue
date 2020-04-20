<template>
  <div class="ActivityContentViewer">
    <template v-if="isDocumentVideo">
      <video controls>
        <source
          :src="videoUrl"
          :type="videoType"
        >
        Sorry, your browser doesn't support embedded videos.
      </video>
    </template>
    <template v-else-if="isDocumentDownload">
      <q-btn
        label="Download"
        icon="cloud_download"
        color="primary"
        @click="download"
      />
    </template>
    <template v-else-if="isLinkYoutube">
      <div class="video-container">
        <!--suppress HtmlDeprecatedAttribute -->
        <iframe
          :src="youtubeUrl"
          width="853"
          height="480"
          frameborder="0"
          allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
          allowfullscreen
        />
      </div>
    </template>
    <template v-else-if="isLinkOpen">
      <q-btn
        label="Abrir"
        icon="open_in_new"
        color="primary"
        @click="open"
      />
    </template>
    <template v-else>
      <div class="flex row items-center justify-center">
        <QSpinner
          color="primary"
          size="6em"
          :thickness="2"
        />
      </div>
    </template>
  </div>
</template>

<script>
import { QSpinner, openURL } from 'quasar'
import { downloadFile } from 'src/settings/storage'

export default {
  /**
   */
  name: 'ActivityContentViewer',
  /**
   */
  components: { QSpinner },
  /**
   */
  props: {
    type: {
      type: String,
      required: true
    },
    documentType: {
      required: true
    },
    document: {
      required: true
    },
    linkType: {
      required: true
    },
    link: {
      required: true
    }
  },
  /**
   */
  computed: {
    /**
     * @return {boolean}
     */
    isDocumentVideo () {
      if (!this.visible) {
        return false
      }
      if (String(this.type) === 'link') {
        return false
      }
      return String(this.documentType) === 'video'
    },
    /**
     * @return {boolean}
     */
    isDocumentDownload () {
      if (!this.visible) {
        return false
      }
      if (String(this.type) === 'link') {
        return false
      }
      return String(this.documentType) !== 'video'
    },
    /**
     * @param {Object} record
     * @return {boolean}
     */
    isLinkYoutube (record) {
      if (!this.visible) {
        return false
      }
      if (String(this.type) === 'document') {
        return false
      }
      return String(this.linkType) === 'youtube'
    },
    /**
     * @return {boolean}
     */
    isLinkOpen () {
      if (!this.visible) {
        return false
      }
      if (String(this.type) === 'document') {
        return false
      }
      return String(this.linkType) !== 'youtube'
    },
    /**
     */
    videoUrl () {
      const baseURL = process.env.VUE_APP_BASE_URL_STATIC
      return `${baseURL}/${this.document}?download=true`
    },
    /**
     */
    videoType () {
      const parts = String(this.document).split('.')
      const extension = parts[parts.length - 1]
      return `video/${extension}`
    },
    /**
     */
    youtubeUrl () {
      const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|&v=)([^#&?]*).*/
      const match = this.link.match(regExp)

      return (match && match[2].length === 11)
        ? `https://www.youtube.com/embed/${match[2]}`
        : this.link
    }
  },
  /**
   */
  data: () => ({
    visible: false
  }),
  /**
   */
  methods: {
    /**
     */
    download () {
      downloadFile(this.document)
    },
    /**
     */
    open () {
      openURL(this.link)
    },
    /**
     */
    makeVisible () {
      this.visible = true
    }
  },
  /**
   */
  mounted () {
    window.setTimeout(this.makeVisible, 800)
  }
}
</script>

<style
  scoped
  lang="stylus"
  rel="stylesheet/stylus"
>
video
  max-width 100%

.video-container
  position relative
  padding-bottom 56.25%
  padding-top 30px
  height 0
  overflow hidden

.video-container iframe,
.video-container object,
.video-container embed
  position absolute
  top 0
  left 0
  width 100%
  height 100%
</style>
