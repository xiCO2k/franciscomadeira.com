module.exports = {
    extends: [
        'eslint:recommended',
        'plugin:vue/vue3-recommended',
    ],
    ignorePatterns: ['node_modules/**/*', 'vendor/**/*', 'public/**/*', 'bootstrap/**/*'],
    parserOptions: {
        ecmaVersion: 12,
        sourceType: 'module',
    },
    plugins: [
        'vue',
    ],
    env: {
        browser: true,
        es2021: true,
        node: true,
    },
    rules: {
        indent: ['error', 4],
        quotes: ['warn', 'single'],
        'no-unused-vars': ['error', { vars: 'all', args: 'after-used', ignoreRestSiblings: true }],
        'comma-dangle': ['warn', 'always-multiline'],
        'vue/html-indent': ['error', 4],
        'vue/multi-word-component-names': ['off'],
        'vue/require-default-prop': ['off'],
        'vue/max-attributes-per-line': ['error', {
            singleline: { max: 3 },
        }],
    },
    globals: {
        route: 'readonly',
        axios: 'readonly',
        defineProps: 'readonly',
        defineEmits: 'readonly',
    },
}
