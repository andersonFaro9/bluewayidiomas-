/**
 * @type {Readonly<{}>}
 */
export const TYPE = Object.freeze({
  TYPE_DOCUMENT: 'document',
  TYPE_LINK: 'link'
})

/**
 * @type {Readonly<{}>}
 */
export const LINK_TYPE = Object.freeze({
  LINK_TYPE_SITE: 'site',
  LINK_TYPE_YOUTUBE: 'youtube'
})

/**
 * @type {Readonly<{}>}
 */
export const DOCUMENT_TYPE = Object.freeze({
  DOCUMENT_TYPE_PDF: 'pdf',
  DOCUMENT_TYPE_OFFICE: 'office',
  DOCUMENT_TYPE_IMAGE: 'image',
  DOCUMENT_TYPE_VIDEO: 'video',
  DOCUMENT_TYPE_AUDIO: 'audio'
})

/**
 * @type {Object}
 */
export const DOCUMENT_ACCEPT = Object.freeze({
  [DOCUMENT_TYPE.DOCUMENT_TYPE_PDF]: 'application/pdf',
  [DOCUMENT_TYPE.DOCUMENT_TYPE_OFFICE]: '.xlsx,.xls,.doc,.docx,.ppt,.pptx,.txt',
  [DOCUMENT_TYPE.DOCUMENT_TYPE_IMAGE]: 'image/*',
  [DOCUMENT_TYPE.DOCUMENT_TYPE_VIDEO]: 'video/*',
  [DOCUMENT_TYPE.DOCUMENT_TYPE_AUDIO]: 'audio/*'
})
