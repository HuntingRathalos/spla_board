import { defineStore } from 'pinia';
import { Party } from '~/types/party';

export const usePartyStore = defineStore({
  id: 'party',
  state: () => {
    return {
      party: null as null | Party,
      // 自分が募集しているもの、参加しているもの、その他で分ける？
      myParty: null as null | Party,
      parties: [
        // {
        //   id: 0,
        //   owner_id: 0,
        //   genre_id: 0,
        //   body: 'string',
        //   start_at: '2022/08/24',
        //   finished_at: '2022/08/24',
        // },
      ] as Party[],
    };
  },
  getters: {},
  actions: {
    async setParty(payload: any) {
      try {
        this.party = payload;
      } catch (error) {
        console.log(error);
      }
    },
    async setParties(payload: any) {
      try {
        console.log(payload);
        this.parties = payload;
      } catch (error) {
        console.log(error);
      }
    },
    async createParty(payload: any) {
      this.parties.push(payload);
    },
    async updateParty(payload: any) {
      this.parties = this.parties.filter((party) => party.id !== payload.id);
      this.parties.unshift(payload);
    },
    async deleteParty(payload: number) {
      this.parties = this.parties.filter((party) => party.id !== payload);
    },
    resetParty() {
      this.party = null;
    },
  },
  persist: true,
});
