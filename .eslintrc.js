module.exports = {
  root: true,
  parser: 'babel-eslint',
  parserOptions: {
    sourceType: 'module'
  },
  env: {
    browser: true,
  },
  extends: 'airbnb-base',
  plugins: [
    'html'
  ],
  settings: {
    'import/resolver': {
      'webpack': {
        'config': 'webpack.config.js'
      }
    }
  },
  rules: {
    'camelcase': ['error', {
      properties: 'never'
    }],
    'import/extensions': ['error', 'always', {
      'js': 'never',
      'scss': 'never',
      'vue': 'never'
    }],
    'import/no-extraneous-dependencies': ['error', {
      'optionalDependencies': ['test/unit/index.js']
    }],
    'linebreak-style': 0,
    'no-param-reassign': ['error', {
      ignorePropertyModificationsFor: [
        'state'
      ]
    }],
    'no-debugger': process.env.NODE_ENV === 'production' ? 2 : 0,
    'no-plusplus': ['error', {
      'allowForLoopAfterthoughts': true
    }],
    'prefer-destructuring': [
      'error', {
        'object': true,
        'array': false
      }
    ],
    'radix': ['error', 'as-needed']
  }
}
