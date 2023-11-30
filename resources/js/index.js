import React, { StrictMode } from "react";
import { createRoot } from "react-dom/client";
import "./styles.css";

import App from "./App";

// console.log('ok')

const root = createRoot(document.getElementById("asdsadsadsadsad"));
root.render(
  <StrictMode>
    <App />
  </StrictMode>
);