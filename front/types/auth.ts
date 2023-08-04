type User = {
  id: number;
  name: string;
  email: number;
  email_verified_at: string;
  two_factor_confirmed_at: string;
  two_factor_recovery_codes: string;
  two_factor_secret: string;
  created_at: Date;
  updated_at: Date;
};

type Credentials = {
  email: string;
  password: string;
};

type RegistrationInfo = {
  name: string;
  email: string;
  password: string;
  password_confirmation: string;
};
export { User, Credentials, RegistrationInfo };
