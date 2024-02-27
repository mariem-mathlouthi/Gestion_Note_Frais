module.exports = {
  root: true,
  env: {
    node: true,
  },
  extends: [
    "plugin:vue/vue3-essential",
    "eslint:recommended",
    // Supprimez "plugin:prettier/recommended" d'ici
  ],
  parserOptions: {
    parser: "@babel/eslint-parser",
  },
  // Retirez la règle suivante
  // "prettier/prettier": 0,
  rules: {
    "no-console": process.env.NODE_ENV === "production" ? "warn" : "off",
    "no-debugger": process.env.NODE_ENV === "production" ? "warn" : "off",
  },
};

