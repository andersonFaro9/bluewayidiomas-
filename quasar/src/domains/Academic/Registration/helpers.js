/**
 * @param {string} value
 * @return {*}
 */
export const gradeLevelFormat = function (value) {
  const options = this.$lang('domains.academic.grade.fields.level.options')
  const option = options.find((option) => option.value === value)
  if (option) {
    return option.label
  }
  return value
}

/**
 * @param {Object} row
 */
export const gradeFormat = function (row) {
  const name = this.$util.get(row, 'name')
  const level = this.$util.get(row, 'level')
  const time = this.$util.get(row, 'shift')
  return `${name} [${level}::${time}]`
}
