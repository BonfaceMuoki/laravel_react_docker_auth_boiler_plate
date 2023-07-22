import { configureStore } from "@reduxjs/toolkit"
import { apiSlice } from "./apiSlice"
import authReducer  from "./authSlice"
import { persistReducer, persistStore,
    FLUSH,
    REHYDRATE,
    PAUSE,
    PERSIST,
    PURGE,
    REGISTER } from 'redux-persist';
import storage from 'redux-persist/lib/storage';

  const authPersistConfig = {
    timeout: 500,
    key: 'auth',
    storage,
  };

// const apiPersistReducer = persistReducer(apiPersistConfig, apiSlice.reducer);
const authPersistReducer = persistReducer(authPersistConfig, authReducer);


export const store = configureStore({
    reducer: {
        [apiSlice.reducerPath]: apiSlice.reducer,
        auth: authPersistReducer
    },
    middleware: getDefaultMiddleware =>
        getDefaultMiddleware({
            serializableCheck: {
              ignoredActions: [FLUSH, PAUSE, PERSIST, PURGE, REGISTER]
            }
          }).concat(apiSlice.middleware),
    devTools: false
})
export const persistor = persistStore(store);
