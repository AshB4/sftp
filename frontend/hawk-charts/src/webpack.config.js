const webpack = require('webpack');

module.exports = {
  // Other configurations...
  resolve: {
    fallback: {
      crypto: false,
    },
  },
  plugins: [
    new webpack.DefinePlugin({
      'process.env.NODE_OPTIONS': JSON.stringify('--openssl-legacy-provider'),
    }),
  ],
};
