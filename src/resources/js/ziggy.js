const Ziggy = {
  url: "http://localhost",
  port: 8082,
  defaults: {},
  routes: {
    homepage: {
      uri: "/",
      methods: ["GET", "HEAD"]
    },
    jobs: {
      uri: "jobs",
      methods: ["GET", "HEAD"]
    },
    "jobs/:id": {
      uri: "jobs.detail",
      methods: ["GET", "HEAD"]
    }
  }
};

if (typeof window !== "undefined" && typeof window.Ziggy !== "undefined") {
  Object.assign(Ziggy.routes, window.Ziggy.routes);
}

export { Ziggy };
