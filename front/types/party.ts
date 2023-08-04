type Party = {
  id: number;
  owner_id: number;
  genre_id: number;
  body: string;
  start_at: Date;
  finished_at: Date;
};

export { Party };
