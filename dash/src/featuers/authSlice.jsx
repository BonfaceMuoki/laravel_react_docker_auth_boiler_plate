import { createSlice } from "@reduxjs/toolkit"
const initialState = {
    mode:"light",
    user:null,
    roles:null,
    permissions:null,
    token:null
};
const authSlice = createSlice({
    name: 'auth',
    initialState,
    reducers: {
        setCredentials: (state, action) => {
            const { user,roles,permissions,access_token } = action.payload
            state.user = user
            state.roles = roles?roles :state.roles
            state.permissions = permissions?permissions :state.permissions 
            state.token =  access_token?access_token :state.access_token
        },
        logOut: (state, action) => {
            state.user = null
            state.token = null
        }

    },
})

export const {setReportSignatories,setReportRecipient,updateUserDetails, setCredentials, logOut,setMode,setfetchvaluationreports,setValuationLocationDetails, setValuationPropertyDetails, setValuationDetails } = authSlice.actions
export default authSlice.reducer
export const selectCurrentUser = (state) => state.auth.user
export const selectCurrentRecipient = (state) => state.auth.reportRecepient
export const selectCurrentSignatories = (state) => state.auth.reportSignatories
export const selectCurrentToken = (state) => state.auth.token
export const selectCurrentRoles = (state) => state.auth.roles
export const selectCurrentPermissions = (state) => state.auth.permissions