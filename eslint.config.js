import js from "@eslint/js";
import prettier from "eslint-plugin-prettier";
import prettierRecommended from "eslint-plugin-prettier/recommended";
import simpleImportSort from "eslint-plugin-simple-import-sort";
import unusedImports from "eslint-plugin-unused-imports";
import pluginVue from "eslint-plugin-vue";

export default [
    {
        ignores: ["node_modules/**/*", "vendor/**/*", "public/**/*"],
    },
    js.configs.recommended,
    ...pluginVue.configs["flat/recommended"],
    prettierRecommended,
    {
        plugins: {
            prettier,
            "simple-import-sort": simpleImportSort,
            "unused-imports": unusedImports,
        },
        rules: {
            "prettier/prettier": ["error"],
            "simple-import-sort/imports": ["error"],
            "simple-import-sort/exports": ["error"],
            "vue/no-v-html": ["off"],
            "vue/no-v-text-v-html-on-component": ["off"],
            "vue/multi-word-component-names": ["off"],
            "vue/require-default-prop": ["off"],
            "vue/require-prop-types": ["off"],
            "vue/no-dupe-keys": ["off"],
            "vue/no-setup-props-destructure": ["off"],
            "no-unused-vars": ["warn", { caughtErrors: "none" }],
            "unused-imports/no-unused-imports": "error",
            "unused-imports/no-unused-vars": [
                "warn",
                {
                    vars: "all",
                    varsIgnorePattern: "^_",
                    args: "after-used",
                    argsIgnorePattern: "^_",
                    caughtErrors: "none",
                },
            ],
            "no-console": ["error"],
        },
        languageOptions: {
            globals: {
                Ziggy: "readonly",
                route: "readonly",
                axios: "readonly",
                google: "readonly",
                Echo: "readonly",
                process: "readonly",
            },
        },
    },
];
