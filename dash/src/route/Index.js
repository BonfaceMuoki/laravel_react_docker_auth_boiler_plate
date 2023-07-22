import React, { useLayoutEffect } from "react";
import { Routes,Route, useLocation } from "react-router-dom";
import Homepage from "../pages/HomePage";
import Layout from "../layout/Index";
import LayoutNoSidebar from "../layout/Index-nosidebar";


const Router = () => {
  const location = useLocation();
  useLayoutEffect(() => {
    window.scrollTo(0, 0);
  }, [location]);

  return (
      <Routes>
        <Route path={`${process.env.PUBLIC_URL}`} element={<Layout />}>
          <Route index element={<Homepage />}></Route>
        </Route>
      </Routes>
  );
};
export default Router;
